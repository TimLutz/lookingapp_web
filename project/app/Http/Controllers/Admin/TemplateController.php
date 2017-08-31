<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\EmailTemplate;
use App\EmailTemplateAttribute;
use App\Http\Requests\EmailTemplateRequest;
use App\Http\Requests\EditTemplateRequest;
use Illuminate\Http\Request;
use Flash;
use Crypt;

class TemplateController extends Controller {
	
	public function __construct()
	{
		$this->middleware('admin');
	}
	
	/**
     * Created By: Lovepreet Singh
     * Created for: Index function for email template
     * created date:August 2017
     */
	public function index()
	{
		try
		{
			$active = 'template';
			$templates = EmailTemplate::orderBy('id', 'DESC')->get();
			return view('admin.template.index', compact('templates','active'));
		}
		catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage()
            ];
			return view('errors.error', $result);
        }
	}

	/**
     * Created By: Lovepreet Singh
     * Created for: create page for email template
     * created date:August 2017
     */
	public function create()
	{
		try
		{
			$active = 'template';
			return view('admin.template.create',compact('active'));
		}
		catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage()
            ];
			return view('errors.error', $result);
        }
	}

	/**
     * Created By: Lovepreet Singh
     * Created for: creating email template
     * created date:August 2017
     */
	public function store(EmailTemplateRequest $request)
	{
		try
		{
			$active = 'template';
			$data = $request->all();
			if(!empty($data['content']))
			{
				$data['content'] = trim(preg_replace('/&#?[a-z0-9]+;/i', ' ', $data['content']));
				$content = strip_tags($data['content']);
				if(empty($content))
				{
						flash()->error('The content field is required');
					return redirect(getenv('adminurl').'/template/create');		
				}
			}
			$template = EmailTemplate::create($request->all());
			
			$count = 0;
			if(isset($request->variable)){
				$attributes=$request->variable;
				foreach($attributes as $attribute)
				{
					$object = new EmailTemplateAttribute(['variable' => $attribute]);
					$template->template_attributes()->save($object);
					$count = 1;
				}
			}
			if($count==1)
			{
				flash()->success('Template has been created!!');
			}
			else
			{
				flash()->success('Template can not be created!!');
			}
		
			return redirect(getenv('adminurl').'/template');
		}
		catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'template'
            ];
			return view('errors.error', $result);
        }
	}



    public function show($id)
    {	
		//fgfghgj
    }
	/**
     * Created By: Lovepreet Singh
     * Created for:getting edit page of email template
     * created date:August 2017
     */
	public function edit($id)
	{
		try
		{
			$id = \Crypt::decrypt($id);
			$active = 'template';
			$template = EmailTemplate::findOrfail($id);
			$attributes=$template->template_attributes->lists('variable','variable');
			return view('admin.template.edit', compact('template','attributes','active'));
		}
		catch (\Exception $e) 
		{ 
			if($e->getMessage() == 'The payload is invalid.')
			{
				$result = [
					'exception_message' => 'template id is not defined',
					'active' => 'testimonials'
				]; 
			}
			else
			{
				$result = [
					'exception_message' => $e->getMessage(),
					'active' => 'template'
				]; 
			}
            
			return view('errors.error', $result);
		}
    }

	

/**
     * Created By: Lovepreet Singh
     * Created for: update email template
     * created date:August 2017
     */
	public function update($id, EmailTemplateRequest $request)
	{
		try
		{
			$id = \Crypt::decrypt($id);
			$data = $request->all();
			if(!empty($data['content']))
			{
				$data['content'] = trim(preg_replace('/&#?[a-z0-9]+;/i', ' ', $data['content']));
				$content = strip_tags($data['content']);
				if(empty($content))
				{
						flash()->error('The content field is required');
					return redirect(getenv('adminurl').'/template/'.\Crypt::encrypt($id).'/edit');		
				}
			}
			$template = EmailTemplate::findOrfail($id);
			if($template->update($request->all()))
			{
				flash()->success('Template has been updated!!');
			}
			else
			{
				flash()->error('Template can not be updated!!');
			}
		}
		catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage()
            ];
			return view('errors.error', $result);
        }
		return redirect(getenv('adminurl').'/template');
	}

	/**
     * Created By: Lovepreet Singh
     * Created for: delete email template
     * created date:August 2017
     */
	public function destroy($id)
	{
		try
		{
			if(EmailTemplate::destroy($id))
			{
				flash()->success('Template has been deleted!!');
			}
			else
			{
				flash()->error('Template can not be deleted!!');
			}
		}
		catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage()
            ];
			return view('errors.error', $result);
        }
		return redirect('admin/template');
	}

}
