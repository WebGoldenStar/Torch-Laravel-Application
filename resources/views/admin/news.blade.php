@extends('layouts.master')

@section('title')

@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> News</h4>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" id="btnAdd" onclick="onAddClick()">+Add</button>
                </div>
                <div class="card-body">
                <div class="table-responsive" style="overflow:hidden;">
                    <table class="table table-striped table-hover table-bordered" id="dtBasicExample">
                        <thead class=" text-primary">
                            <th width="5%">#</th>
                            <th width="15%">Title</th>
                            <th width="15%">Poster</th>
                            <th width="45%">Content</th>                        
                            <th width="10%">Date</th>                            
                            <th width="10%">    </th>
                                              
                        </thead>
                        <tbody>
                            @foreach($news as $index => $new)
                            <tr>
                                <td style="text-align:center;">{{$index+1}}</td>
                                <td ><p class='content_title'>{{$new->title}} </p></td>
                                <td style="text-align:center;">
                                	<img src='uploads/{{$new->poster_url}}' style="max-width:100px;"/>
                                </td>
                                <td ><p class='content_body'>{{$new->content}}</p></td>                        
                                <td style="text-align:center;">{{$new->created_at}}</td>                                
                                <td style="text-align:center;">    
                                    <button class="btn btn-primary" onclick="editItem({{$new}})"><i class="now-ui-icons files_paper"></i></button>
                                    <button class="btn btn-warning" onclick="deleteItem({{$new->id}})"><i class="now-ui-icons ui-1_simple-remove"></i></button>
                                </td>
                            </tr>
                            @endforeach                            
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>    

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">            
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">                    
                    
                    <form method="post" action="/api/v1/news" enctype="multipart/form-data">
                        <div class="modal-header">
                            <input name="newsid" class="modal-title" id="modalTitle" value="News" readonly />
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">                        
                            <div class="form-group">
                                <label for="title-text">Title</label>
                                <input name="title" class="form-control" id="title-text" placeholder="Title Here"/>
                            </div>
                            <div class="form-group">
                                <label for="content-text">Content</label>
                                <textarea name="content" class="form-control" id="content-text" placeholder="Content Here"></textarea>
                            </div>
                            <div class="form-group text-center form-group-border">                                                            
                                <input type='file' id="imgInp" name="image"/>
                                <img name="poster_url"  id="blah" src="../images/folderIcon.png" alt="Add new Image" />                                
                            </div>                        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"  id="btnClosePopup">Close</button>
                            <input type="submit" class="btn btn-primary" id="btnSavePopup" value="Save"/>
                        </div>
                    </form> 
                </div>                
            </div>
        </div>    
    </div>    

@endsection

@section('scripts')

@endsection