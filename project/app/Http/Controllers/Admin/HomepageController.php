<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Http\Requests\SliderEditRequest;
use App\Http\Requests\GridEditRequest;
use App\Http\Requests\GridRequest;
use App\models\Homepage;
use App\models\Product;
use App\models\Category;
use App\models\SubCategory;

class HomepageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSlider()
    {
		 try
		{
			$active= 'slider';
			 $sliders = Homepage::where('type',0)->get();
			 
			return view('admin.slider.index', compact('sliders','active'));
		}
		catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'slider'
            ];
			return view('errors.error', $result);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getGrid()
    {
         try
		{
			$active= 'grid';
			 $grids = Homepage::where('type',1)->get();
			 
			return view('admin.grid.index', compact('grids','active')); 
		}
		catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'grid'
            ];
			return view('errors.error', $result);
        }
    }



/*****************************************************************************************************************************************
 * *****************************************************************************************************************************************
 * *****************************************************************************************************************************************
										 * Below are the Functions for Sliders 
										  created by: Jagraj Singh
										  created On: 3 june 2016
*****************************************************************************************************************************************				*****************************************************************************************************************************************			*******************************************************************************************************************************************/
    public function getCreateslider()
    {
		
       try
		{
		$active= 'slider';
        
         return view('admin.slider.create', compact('active'));
         }
		catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'slider'
            ];
			return view('errors.error', $result);
        }
         
    }
    
    
    
    
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreateslider(SliderRequest $request)
    {
		
       try
		{
			
			$home = new Homepage;
			if($request['type'] == 0)
			{
				$home->type = 0;
				$home->type_value = $request['type'];
				$home->name = $request['nameimage'];
				$home->button_text = $request['button_text'];
				$home->description = $request['descriptionimage'];
				$home->image = $request['imagepro'];
				$dir = 'tmp/';
				rename($dir.$home->image,'uploads/'.$home->image);
				$home->thumbnail = $request['thumbnail'];
				rename($dir.$home->thumbnail,'uploads/'.$home->thumbnail);
				$home->status = $request['status'];
				$home->url = $request['url'];
				$home->sort_num = $request['sort_num'];
				$imga = $home->save();
				if($imga)
				{
					flash()->success("Slider's Image has been created !!");
				}
				else
				{
					flash()->error('Something went wrong!!');
				}
                return redirect('admin/homepage/slider'); 
				
			}
			if($request['type'] == 1)
			{
				$home->type = 0;
				$home->type_value = $request['type'];
				$home->name = $request['namevideo'];
				$home->button_text = $request['button_text'];
				$home->description = $request['descriptionvideo'];
				$home->url = $request['url'];
				$home->status = $request['status'];
				$home->sort_num = $request['sort_num'];
				$vid = $home->save();
				if($vid)
				{
					flash()->success("Slider's Video has been created !!");
				}
				else
				{
					flash()->error('Something went wrong!!');
				}
                return redirect('admin/homepage/slider'); 
			}
			
         }
		catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'slider'
            ];
			return view('errors.error', $result);
        }
         
    }
    
    
    
    
    
    
    
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public function getEditslider($id)
    {
		
       try
		{
		 $home_id = \Crypt::decrypt($id);
		 
		$type =  Homepage::where('id',$home_id)->pluck('type_value');
        //image
        if($type == 0){
			$sliders =  Homepage::findOrfail($home_id);
			$active= 'slider';
			return view('admin.slider.editimg', compact('sliders','active'));
		}
		//video
		if($type == 1){
			$sliders =  Homepage::findOrfail($home_id);
			$active= 'slider';
			return view('admin.slider.editvid', compact('sliders','active'));
		}
		//$active= 'slider';
        
         //return view('admin.slider.editimg', compact('active'));
         }
		catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'slider'
            ];
			return view('errors.error', $result);
        }
         
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postUpdateslider(SliderEditRequest $request,$id)
    {
      try
		{
			 $request->all();
			$home_id = \Crypt::decrypt($id);
			$home = Homepage::findOrfail($home_id);
			
			if($request['type'] == 0)
			{
				$check = Homepage::where('type',0)->where('type_value',0)->where('id','!=',$home_id)->where('sort_num',$request['sort_num'])->count();
				if($check == 0)
				{
					$home->type = 0;
					$home->type_value = $request['type'];
					$home->name = $request['nameimage'];
					$home->button_text = $request['button_text'];
					$home->description = $request['descriptionimage'];
					if(isset($request['imagepro']))
					{
						$deleted_image = unlink('uploads/'.$home->image);
						$img = $request['imagepro'];

						$home->image = $img;

						$home->update();
						$dir = 'tmp/';
						rename($dir.$img,'uploads/'.$img);

					}
					if(isset($request['thumbnail']))
					{
						$deleted_image = unlink('uploads/'.$home->thumbnail);
						$img2 = $request['thumbnail'];
						$home->thumbnail = $img2;
						$home->update();
						$dir = 'tmp/';
						rename($dir.$img2,'uploads/'.$img2);
					}
					$home->sort_num = $request['sort_num'];
					$home->url = $request['url'];
					$home->status = $request['status'];
					$imga = $home->update();
					if($imga)
					{
						flash()->success('Slider\'s Image has been updated !!');
					}
					else
					{
						flash()->error('Something went wrong!!');
					}
					return redirect('admin/homepage/slider'); 
				}
				else
				{
					flash()->error('Fail!! Order Number already taken');
					return back()->withInput();
				}
			}
			if($request['type'] == 1)
			{
			 $check = Homepage::where('type',0)->where('type_value',1)->where('id','!=',$home_id)->where('sort_num',$request['sort_num'])->count();
				if($check == 0)
				{
				$home->type = 0;
				$home->type_value = $request['type'];
				$home->name = $request['namevideo'];
				$home->description = $request['descriptionvideo'];
				$home->button_text = $request['button_text'];
				$home->url = $request['url'];
				$home->sort_num = $request['sort_num'];
				$home->status = $request['status'];
				$vid = $home->update();
				if($vid)
				{
					flash()->success('Slider\'s Video has been updated !!');
				}
				else
				{
					flash()->error('Something went wrong!!');
				}
                return redirect('admin/homepage/slider'); 
				}
				else
			{
			flash()->error('Fail!! Order Number already taken');
			return back()->withInput();
			}
			}
			
         }
		catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'slider'
            ];
			return view('errors.error', $result);
        }
    }







/*****************************************************************************************************************************************
 * *****************************************************************************************************************************************
 * *****************************************************************************************************************************************
										 * Below are the Functions for Grid 
										  created by: Jagraj Singh
										  created On: 3 june 2016
*****************************************************************************************************************************************				*****************************************************************************************************************************************			*******************************************************************************************************************************************/




    public function getCreategrid()
    {
		
       try
		{
		$active= 'grid';
       $categories = Category::where('id','!=','')->lists('name','id')->toArray();
         return view('admin.grid.create', compact('active','categories'));
         }
		catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'grid'
            ];
			return view('errors.error', $result);
        }
         
    }
    
    
    
    
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreategrid(GridRequest $request)
    {
		
       try
		{
		
			$home = new Homepage;
			
			
			if($request['type'] == 2)
			{
				$prod_name = Product::where('id',$request['product'])->pluck('name');
				$prod_des = Product::where('id',$request['product'])->pluck('description');				
				$home->type = 1;
				$home->type_value = $request['type'];
				$home->name = $prod_name;
				$home->description = $prod_des;
				$home->product_id = $request['product'];
				$home->sort_num_grid = $request['sort_num_pro'];
				$home->status = $request['status'];
				$vid = $home->save();
				if($vid)
				{
					flash()->success('Grids\'s Product has been created !!');
				}
				else
				{
					flash()->error('Something went wrong!!');
				}
                return redirect('admin/homepage/grid'); 
			}
			
			
			if($request['type'] == 3)
			{
				//print_r($request->all()); die;
				$home->type = 1;
				$home->type_value = $request['type'];
				$home->name = $request['nameimage'];
				$home->description = $request['descriptionimage'];
				$home->url = $request['url'];
				$home->sort_num_grid = $request['sort_num_img'];
				$home->image = $request['imagepro'];
				$home->urltype = $request['urltype'];
				$dir = 'tmp/';
				rename($dir.$home->image,'uploads/'.$home->image);
				$home->status = $request['status'];
				$imga = $home->save();
				if($imga)
				{
					flash()->success('Grids\'s Image has been created !!');
				}
				else
				{
					flash()->error('Something went wrong!!');
				}
                return redirect('admin/homepage/grid'); 
				
			}
			
			
         }
		catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'grid'
            ];
			return view('errors.error', $result);
        }
         
    }
    
    
    
    
    
    
    
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public function getEditgrid($id)
    {
		
       try
		{
		 $home_id = \Crypt::decrypt($id);
		 
		$type =  Homepage::where('id',$home_id)->pluck('type_value');
		//product
		if($type == 2){
			$grids =  Homepage::findOrfail($home_id);
			 $categories = Category::where('id','!=','')->lists('name','id')->toArray();
			
			 $prod = Product::where('id',$grids['product_id'])->lists('name','id')->toArray();
			  $cat = Product::where('id',$grids['product_id'])->pluck('cat_id');
			   $subcats = SubCategory::where('url_type',0)->where('category_id',$cat)->lists('name','id')->toArray();
			 $subcat = Product::where('id',$grids['product_id'])->pluck('sub_cat_id');
			$active= 'grid';
			return view('admin.grid.editprod', compact('grids','active','prod','categories','cat','subcats','subcat'));
		} 
        //image
        if($type == 3){
			
			$grids =  Homepage::findOrfail($home_id);
			$active= 'grid';
			return view('admin.grid.editimg', compact('grids','active'));
		}
		
		
         }
		catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'slider'
            ];
			return view('errors.error', $result);
        }
         
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postUpdategrid(GridEditRequest $request,$id)
    {
      try
		{
			
			 $home_id = \Crypt::decrypt($id);
			$home = Homepage::findOrfail($home_id);
			
			if($request['type'] == 2)
			{
				$check = Homepage::where('type',1)->where('type_value',2)->where('id','!=',$home_id)->where('sort_num_grid',$request['sort_num_pro'])->count();
				if($check == 0)
				{
				$prod_name = Product::where('id',$request['product'])->pluck('name');
				$prod_des = Product::where('id',$request['product'])->pluck('description');
				
				$home->type = 1;
				$home->type_value = $request['type'];
				$home->name = $prod_name;
				$home->description = $prod_des;
				$home->product_id = $request['product'];
				$home->sort_num_grid = $request['sort_num_pro'];
				$home->status = $request['status'];
				$vid = $home->update();
				if($vid)
				{
					flash()->success('Grid\'s Video has been updated !!');
				}
				else
				{
					flash()->error('Something went wrong!!');
				}
                return redirect('admin/homepage/grid'); 
			}
			else{
				flash()->error('Fail!! Order Number already taken');
				return back()->withInput();
			}
			}
			
			
			if($request['type'] == 3)
			{
				$check = Homepage::where('type',1)->where('type_value',3)->where('id','!=',$home_id)->where('sort_num_grid',$request['sort_num_img'])->count();
				if($check == 0)
				{
				$home->type = 1;
				$home->type_value = $request['type'];
				$home->name = $request['nameimage'];
				$home->url = $request['url'];
				$home->description = $request['descriptionimage'];
				$home->sort_num_grid = $request['sort_num_img'];
				$home->urltype = $request['urltype'];
				if(isset($request['imagepro']))
				{

				$deleted_image = unlink('uploads/'.$home->image);
				$img = $request['imagepro'];




				$home->image = $img;

				$home->update();
				$dir = 'tmp/';
				rename($dir.$img,'uploads/'.$img);


				}
				
				$home->status = $request['status'];
				
				
				$imga = $home->update();
				if($imga)
				{
					flash()->success('Grid\'s Image has been updated !!');
				}
				else
				{
					flash()->error('Something went wrong!!');
				}
                return redirect('admin/homepage/grid'); 
                }
			else{
				flash()->error('Fail!! Order Number already taken');
				return back()->withInput();
			}
				
			}
			
			
         }
		catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'slider'
            ];
			return view('errors.error', $result);
        }
    }



public function postCatproduct(request $request)
    {
		try
		{
		$cat_id =  $request->cat;
		$sub_cat_id =  $request->subcat;
		$prod = Product::where('cat_id',$cat_id)->where('sub_cat_id',$sub_cat_id)->lists('name','id')->toArray();
		return view('admin.grid.ajax_prod', compact('prod'));
		 }
		catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'grid'
            ];
			return view('errors.error', $result);
        }
    }








}
