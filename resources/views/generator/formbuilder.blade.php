@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Form Builder</div>

                <div class="panel-body" id="formbuilder">

                    <form action="/build" method="POST">

                        {{ csrf_field() }}

                        <div class="row builder_row">
                            <div class="col-md-2">
                                <label for="">Object Name (singular)</label>
                                <input type="text" name="object_name" id="object_name" class="form-control"  placeholder="">
                            </div>
                            <div class="col-md-2">
                                <label for="">Controller Name</label>
                                <input type="text" name="controller_name" id="controller_name" class="form-control"  placeholder="">
                            </div>
                            <div class="col-md-2">
                                <label for="">Model Name</label>
                                <input type="text" name="model_name" id="model_name" class="form-control"  placeholder="">
                            </div>
                            <div class="col-md-2">
                                <label for="">View Folder Name</label>
                                <input type="text" name="view_name" id="view_name" class="form-control"  placeholder="">
                            </div>
                            <div class="col-md-2">
                                <label for="">Table Name</label>
                                <input type="text" name="table_name" id="table_name" class="form-control"  placeholder="">
                            </div>
                            <div class="col-md-2">
                                <label for="">Table PK</label>
                                <input type="text" name="table_pk" id="table_pk" class="form-control" value="id"  placeholder="">
                            </div>
                            <div class="col-md-4" style="padding-top:25px;">
                                <button type="submit" class="btn btn-primary">Generate</button>
                            </div>
                        </div>

                        <div class="progress">
                            <div class="progress-bar progress-bar-warning" style="width: 95%">
                                <span class="sr-only">35% Complete (success)</span>
                            </div>
                        </div>

                        @for ($i=1;$i<=$fieldTotal;$i++)

                            <div class="row builder_row">
                            <div class="col-md-2">
                                <label for="">Key</label>
                                <input type="text" name="fieldKey_{{ $i }}" class="form-control field_key"  placeholder="first_name">
                            </div>
                            <div class="col-md-2">
                                <label for="formlabel">Label</label>
                                <input type="text" name="fieldLabel_{{ $i }}" class="form-control field_label" id="" placeholder="First Name">
                            </div>
                            <div class="col-md-2">
                                <label for="">Field Type</label>
                                <select name="fieldType_{{ $i }}" class="form-control">
                                    <option value="text">Textfield</option>
                                    <option value="select">Dropdown</option>
                                    <option value="checkbox">Checkbox</option>
                                    <option value="radio">Radio</option>
                                    <option value="textarea">Textarea</option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label for="">Field Class</label>
                                <input type="text" name="fieldClass_{{ $i }}" class="form-control"  value="form-control" placeholder="form-control">
                            </div>

                            <div class="col-md-2">
                                <label for="">Field Id</label>
                                <input type="text" name="fieldId_{{ $i }}" class="form-control"  placeholder="first_name">
                            </div>

                            <div class="col-md-2">
                                <label for="">Show In</label>
                                <select name="showField_{{ $i }}" class="form-control">
                                    <option value="both">Create & Edit</option>
                                    <option value="create">Create Only</option>
                                    <option value="edit">Edit Only</option>
                                    <option value="none">None</option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label for="">Relationship</label>
                                <input type="text" name="fieldRelationship_{{ $i }}" class="form-control"  placeholder="relationship name">
                                <input type="text" name="fieldRelationshipModel_{{ $i }}" class="form-control"  placeholder="relationship model name">
                                <input type="text" name="fieldRelationshipFK_{{ $i }}" class="form-control"  placeholder="relationship key">
                            </div>

                            <div class="col-md-2">
                                <label for="">Value</label>
                                <input type="text" name="fieldValue_{{ $i }}" class="form-control"  placeholder="">
                            </div>

                            <div class="col-md-2">
                                <label for="">Placeholder</label>
                                <input type="text" name="fieldPlaceholder_{{ $i }}" class="form-control"  placeholder="John Doe">
                            </div>
                            <div class="col-md-4">
                                <label for="">Validation</label>
                                <div>

                                    <input type="checkbox" id="inlineCheckbox1" value="option1"> Required

                                    <input type="checkbox" id="inlineCheckbox2" value="option2"> Alpha

                                    <input type="checkbox" id="inlineCheckbox3" value="option3"> Numeric

                                </div>

                            </div>
                            <div class="col-md-2">
                                <label for="">Extra Validation Rule</label>
                                <input type="text" name="fieldExtraValidation_{{ $i }}" class="form-control"  placeholder="">
                            </div>

                        </div>

                            <div class="progress">
                                <div class="progress-bar progress-bar-success" style="width: 35%">
                                    <span class="sr-only">35% Complete (success)</span>
                                </div>
                                <div class="progress-bar progress-bar-warning progress-bar-striped" style="width: 20%">
                                    <span class="sr-only">20% Complete (warning)</span>
                                </div>
                                <div class="progress-bar progress-bar-info progress-bar-striped" style="width: 40%">
                                    <span class="sr-only">10% Complete (danger)</span>
                                </div>
                            </div>

                        @endfor

                        <input type="hidden" name="fieldTotal" value="{{ $fieldTotal }}">

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_script')

    <script type="text/javascript">
        $( document ).ready(function() {

            $( "#object_name" ).keyup(function() {
                var object_name = $(this).val();
                generateControllerModelViewName(object_name);
            });

            $( ".field_key" ).keyup(function() {
                var field_key = $(this).val();
                var label = generateLabelName(field_key);
            });

            function generateLabelName(field_key) {

            }

            //expected output
            //ProductsController.php
            //Product.php
            //resources/products

            function generateControllerModelViewName(object_name) {

                var split_obj = object_name.split(" ");

                var controller_prefix = '';

                if (split_obj.length>0) {
                    for (var i = 0; i < split_obj.length; i++) {
                        controller_prefix = controller_prefix + ucfirst(split_obj[i]);
                    }
                }
                else{
                    controller_prefix = ucfirst(object_name);
                }

                var table_name = object_name.toLowerCase().replace(/ /g,"_")+'s';
//                var view_folder_name = controller_prefix.toLowerCase()+'s';
                var view_folder_name = table_name;

                var controller_name = controller_prefix + 'sController.php';
                var model_name = controller_prefix + '.php';
                var view_name = 'resources/'+view_folder_name;

                $( "#controller_name" ).val(controller_name);
                $( "#model_name" ).val(model_name);
                $( "#view_name" ).val(view_name);
                $( "#table_name" ).val(table_name);

            }

            function ucfirst(s)
            {
                return s && s[0].toUpperCase() + s.slice(1);
            }

        });
    </script>

@endsection