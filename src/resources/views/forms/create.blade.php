<form class="form-horizontal" action="{{route('post.store')}}" method="post">
  {{ csrf_field() }}

  <div class="form-group">
    <label for="title" class="control-label sr-only">Title</label>
    <div class="col-md-offset-1 col-sm-10">
      <input type="text" class="form-control" id="title" name="title" placeholder="Title">
    </div>
  </div>

  <div class="form-group">
    <label for="body" class="control-label sr-only">Body</label>
    <div class="col-md-offset-1 col-sm-10">
      <textarea class="form-control" id="body" name="body" placeholder="Text body ..." rows="3"></textarea>
    </div>
  </div>

  <div class="form-group">
    <label for="tags" class="control-label sr-only">Tags</label>
    <div class="col-md-offset-1 col-sm-10">
      <input type="text" class="form-control" id="tags" data-role="tagsinput" data-live-search="true" name="tags[]" placeholder="Tags">
    </div>
  </div>

  <div class="form-group">
     <div class="col-sm-offset-1 col-sm-10">
       <div class="checkbox">
         <label>
           <input type="checkbox" name="online" value="1"> Publish
         </label>
       </div>
     </div>
   </div>

  <div class="form-group">
    <div class="col-sm-offset-1 col-sm-10">
      <button type="submit" class="btn btn-primary pull-right">Save</button>
    </div>
  </div>

</form>
