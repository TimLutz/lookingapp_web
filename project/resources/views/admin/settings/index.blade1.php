@extends('admin.layout')
@section('title')
	 Settings
@endsection
@section('heading')
	Manage Setting
    <a href="{{url('admin/settings/create')}}" class="btn btn-primary btn-sm pull-right">Add Setting</a>
@endsection
@section('content')
	<div class="row">
  
    
                <div class="col-md-12">
                    @include('flash::message')
                    <div class="portlet box">
                        <div class="portlet-title">
                            <div class="caption caption-md">
                            <i class="icon-bar-chart theme-font hide"></i>
                                            <span class="caption-subject font-blue-madison bold uppercase">Manage Services</span>
                            </div>
                                        
                        </div>
                        <div class="portlet-body">
                            <div id="sample_6_wrapper" class="dataTables_wrapper no-footer">
                                <div class="row">
                            
                                </div>
                                
                                    <table id="sample_service" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="sample_6_info">
                            <thead>
                            <tr role="row">
                                <th>S No.</th>
                                <th>Title</th>
                                <th>Mode Type</th>
                                <th>Value</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            if(count($services) && isset($services))
                            {    
                                $i = 1; 
                            ?>
                            @foreach($services AS $service)
                                <?php $settingId = Crypt::encrypt($service->id); 
                              
                                ?>
                                <tr>
                                          <td>{{ $i }}</td>
                                        <td>
                                            {{ $service->title }}    
                                        </td>
                                        <td>
                                            {{ $service->mode_type }}
                                        </td>
                                        <td>
                                            {{ $service->value }}
                                        </td>
                                        <td>
                                            {!! Form::open(['method' => 'post' ]) !!}
                                            {!! $service->setStatus($settingId, $service->status) !!}
                                            {!! Form::close() !!}
                                        </td>                                       
                                        <td>
                                            {!! Form::open(['id' => 'deletePageForm','url' => 'admin/settings/'.$settingId,'method' => 'post' ]) !!}
                                            <a href="settings/{{ $settingId }}/edit"><span style="color:orange" title="Edit" class="icon-pencil btn btn-circle btn-icon-only btn-default" aria-hidden="true"></span></a>
                                            {!! Form::hidden('table','settings',['class' => 'form-control']) !!}
                                            
                                        {!! Form::close() !!}
                                        </td>
                                        
                                    </tr>                               
                                    <?php
                                     $i += 1; 
                                
                                     ?>
                                    @endforeach
                                 <?php
                            }
                            else
                            {

                            } ?>        
                            </tbody>
                            </table>
                                </div>
            
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="portlet box">
                        <div class="portlet-title">
                            <div class="caption caption-md">
                            <i class="icon-bar-chart theme-font hide"></i>
                                            <span class="caption-subject font-blue-madison bold uppercase">Manage Tax</span>
                            </div>
                                        
                        </div>
                        <div class="portlet-body">
                            <div id="sample_6_wrapper" class="dataTables_wrapper no-footer">
                                <div class="row">
                            
                                </div>
                                
                                    <table id="sample_vat" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="sample_6_info">
                            <thead>
                            <tr role="row">
                                <th>S No.</th>
                                <th>Title</th>
                                <th>Mode Type</th>
                                <th>Value</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(count($taxes) && isset($taxes))
                            { 
                                $i = 1; 
                            ?>
                            @foreach($taxes AS $tax)
                                <?php $settingId = Crypt::encrypt($tax->id); 
                                
                                ?>
                                <tr>
                                          <td>{{ $i }}</td>
                                        <td>
                                            {{ $tax->title }}    
                                        </td>
                                        <td>
                                            {{ $tax->mode_type }}
                                        </td>
                                        <td>
                                            {{ $tax->value }}
                                        </td>
                                        <td>
                                            {!! Form::open(['method' => 'post' ]) !!}
                                            {!! $tax->setStatus($settingId, $tax->status) !!}
                                            {!! Form::close() !!}
                                        </td>                                       
                                        <td>
                                            {!! Form::open(['id' => 'deletePageForm','url' => 'admin/settings/'.$settingId,'method' => 'post' ]) !!}
                                            <a href="settings/{{ $settingId }}/edit"><span style="color:orange" title="Edit" class="icon-pencil btn btn-circle btn-icon-only btn-default" aria-hidden="true"></span></a>
                                            {!! Form::hidden('table','settings',['class' => 'form-control']) !!}
                                            
                                        {!! Form::close() !!}
                                        </td>
                                        
                                    </tr>

                                    <?php 
                                    $i += 1; 
                                
                                    ?>
                                    @endforeach
                                 <?php
                            }
                            else
                            {

                            } ?>                                    
                            </tbody>
                            </table>
                                </div>
            
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="portlet box">
                        <div class="portlet-title">
                            <div class="caption caption-md">
                            <i class="icon-bar-chart theme-font hide"></i>
                                            <span class="caption-subject font-blue-madison bold uppercase">Manage Radius</span>
                            </div>
                                        
                        </div>
                        <div class="portlet-body">
                            <div id="sample_6_wrapper" class="dataTables_wrapper no-footer">
                                <div class="row">
                            
                                </div>
                                
                                    <table id="sample_radius" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="sample_6_info">
                            <thead>
                            <tr role="row">
                                <th>S No.</th>
                                <th>Title</th>
                                <th>Mode Type</th>
                                <th>Value</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            if(count($radius) && isset($radius))
                            {
                            $i = 1; 
                            ?>
                            @foreach($radius AS $radiu)
                                <?php $settingId = Crypt::encrypt($radiu->id); 
                                if($radiu->type == 'radius')
                                { 
                                ?>
                                        <tr>
                                          <td>{{ $i }}</td>
                                        <td>
                                            {{ ucfirst($radiu->title) }}    
                                        </td>
                                        <td>
                                            {{ $radiu->mode_type }}
                                        </td>
                                        <td>
                                            {{ $radiu->value }}
                                        </td>
                                        <td>
                                            {!! Form::open(['method' => 'post' ]) !!}
                                            {!! $radiu->setStatus($settingId, $radiu->status) !!}
                                            {!! Form::close() !!}
                                        </td>                                       
                                        <td>
                                            {!! Form::open(['id' => 'deletePageForm','url' => 'admin/settings/'.$settingId,'method' => 'post' ]) !!}
                                            <a href="settings/{{ $settingId }}/edit"><span style="color:orange" title="Edit" class="icon-pencil btn btn-circle btn-icon-only btn-default" aria-hidden="true"></span></a>
                                            {!! Form::hidden('table','settings',['class' => 'form-control']) !!}
                                            
                                        {!! Form::close() !!}
                                        </td>
                                        
                                    </tr>
                                    <?php 
                                    $i += 1; 
                                }
                                    ?>
                                    @endforeach
                                    <?php
                            }
                            else
                            {

                            } ?>
                            </tbody>
                            </table>
                                </div>
            
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="portlet box">
                        <div class="portlet-title">
                            <div class="caption caption-md">
                            <i class="icon-bar-chart theme-font hide"></i>
                                            <span class="caption-subject font-blue-madison bold uppercase">Manage Charge</span>
                            </div>
                                        
                        </div>
                        <div class="portlet-body">
                            <div id="sample_6_wrapper" class="dataTables_wrapper no-footer">
                                <div class="row">
                            
                                </div>
                                
                                    <table id="sample_charge" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="sample_6_info">
                            <thead>
                            <tr role="row">
                                <th>S No.</th>
                                <th>Title</th>
                                <th>Mode Type</th>
                                <th>Value</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            if(count($charges) && isset($charges))
                            {
                             $i = 1; 
                            
                            ?>
                            @foreach($charges AS $charge)
                                <?php $settingId = Crypt::encrypt($charge->id); 
                              
                                    ?>
                                    <tr>
                                          <td>{{ $i }}</td>
                                        <td>
                                            {{ $charge->title }}    
                                        </td>
                                        <td>
                                            {{ $charge->mode_type }}
                                        </td>
                                        <td>
                                            {{ $charge->value }}
                                        </td>
                                        <td>
                                            {!! Form::open(['method' => 'post' ]) !!}
                                            {!! $charge->setStatus($settingId, $charge->status) !!}
                                            {!! Form::close() !!}
                                        </td>                                       
                                        <td>
                                            {!! Form::open(['id' => 'deletePageForm','url' => 'admin/settings/'.$settingId,'method' => 'post' ]) !!}
                                            <a href="settings/{{ $settingId }}/edit"><span style="color:orange" title="Edit" class="icon-pencil btn btn-circle btn-icon-only btn-default" aria-hidden="true"></span></a>
                                            {!! Form::hidden('table','settings',['class' => 'form-control']) !!}
                                            
                                        {!! Form::close() !!}
                                        </td>
                                        
                                    </tr>
                                    <?php 
                                    $i += 1; 
                                
                                    ?>
                                    @endforeach
                                <?php 
                            }
                            else
                            {
                               echo '<tr><td colspan="6" text-align="center">No record found</td></tr>'; 
                            }
?>
                            </tbody>
                            </table>
                                </div>
            
                        </div>
                    </div>
                </div>
            </div>
@endsection
@section('js')
<script>
jQuery(document).ready(function()
 {  
    $('#sample_service').dataTable({
    "aoColumns": [
              null,
              null,
              null,
              null,
              { "bSortable": false },
              { "bSortable": false }
              ],
    "pageLength": 5                       
    });
    
});
</script>
@endsection