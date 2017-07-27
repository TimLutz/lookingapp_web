<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
class JobsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->get('jobValue');
     //   echo $this->get('jobid');die;
        switch ($this->get('page')) {
            case 'add':
                if($this->get('jobid'))
                {
                    return [
                        //
                        'title'=>'required|custom_title|unique:jobs,_id,'.$id,
                        'job_category'=>'required',
                        'job_subcategory'=>'required',
                        'skills'=>'required',
                        'description'=>'required|custom_description',
                        'start_date'=>'required',
                        'end_date'=>'required|custom_min:'.$this->start_date.'|custom_max:'.$this->start_date,
                        'salary_per_hour'=>'required|between:0,99.99|custom_salaryrange',
                        'number_of_worker_required'=>'required|custom_worker',
                        'address'=>'required|custom_location:'.$this->get('lat').','.$this->get('lat'),
                        'dates'=>'required|datesize',
                    ];
                }
                else
                {
                    return [
                //
                            'title'=>'required|custom_title|unique:jobs',
                            'job_category'=>'required',
                            'job_subcategory'=>'required',
                            'skills'=>'required',
                            'description'=>'required|custom_description',
                            'start_date'=>'required',
                            'end_date'=>'required|custom_min:'.$this->start_date.'|custom_max:'.$this->start_date,
                            'salary_per_hour'=>'required|between:0,99.99|custom_salaryrange',
                            'number_of_worker_required'=>'required|custom_worker',
                            'address'=>'required|custom_location:'.$this->get('lat').','.$this->get('lat'),
                            'dates'=>'required|datesize',
                        ];
                }
                break;
            case 'edit':
                return [
                        //
                        'title'=>'required|custom_title|unique:jobs,_id,'.$id,
                        'job_category'=>'required',
                        'job_subcategory'=>'required',
                        'skills'=>'required',
                        'description'=>'required|custom_description',
                        'start_date'=>'required',
                        'end_date'=>'required|custom_min:'.$this->start_date.'|custom_max:'.$this->start_date,
                        'salary_per_hour'=>'required|between:0,99.99|custom_salaryrange',
                        'number_of_worker_required'=>'required|custom_worker',
                        'address'=>'required|custom_location:'.$this->get('lat').','.$this->get('lat'),
                        'dates'=>'required|datesize',
                    ];
                break;
            default:
                # code...
                break;
        }
        
    }

    public function messages()
    {
        return [
                    'title.required'=>'Please specify Job Name.',
                    'title.unique'=>'Title already exist.',
                    'job_category.required'=>'Please specify the job category.',
                    'job_subcategory.required'=>'Please specify the job sub category.',
                    'skills.required'=>'Please specify skills required for the job.',
                    'description.required'=>'Please specify Job Description.',
                    'start_date.required'=>'Please specify start time of the job.',
                    'end_date.required'=>'Please specify end time of the job.',
                    'salary_per_hour.required'=>'Please specify Salary per hour of the job in dollars.',
                    'salary_per_hour.numeric'=>'Salary should contain numbers.',
                    'number_of_worker_required.numeric'=>'Please specify number of persons required for the job.',
                    'number_of_worker_required.required'=>'Number of persons required should contain numbers.',
                    'address.required'=>'Please specify job location for the job.',
                    'dates.required'=>'Please specify job days for the job.',
                    'dates.datesize'=>'Maximum job length can be 30 days only.',
                    'title.custom_title'=>'Job name should contain alphabets and numbers only within 5 – 50-character range',
                    'description.custom_description'=>'Job Description should contain alphabets, numbers and special characters (“.”,”,”, “(”,”)”, “-”) only within 50 – 250-character range.',
                    'number_of_worker_required.custom_worker'=>'Number of persons required should contain numbers only within 1 - 3-character range.',
                    'salary_per_hour.custom_salaryrange'=>'Salary should contain numbers with two decimal point only within 1 - 4-character range.',
                    'end_date.custom_min'=>'Minimum timeslot should be at least for 1 hour',
                    'end_date.custom_max'=>'Maximum timeslot cannot be more than 14 hours',
                    'address.custom_location'=>'Please specify a valid location.',
               ];
    }
}
