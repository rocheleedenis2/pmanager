@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row col-sm-9 col-md-9 col-lg-9 pull-left">
		<!-- The justified navigation menu is meant for single line per list item.
			 Multiple lines will require custom code not provided by Bootstrap. -->

		<!-- Jumbotron -->
		<div class="well well-lg">
			<h1>{{ $project->name }}</h1>
			<p class="lead">{{ $project->description }}</p>
			<!-- <p><a class="btn btn-lg btn-success" href="#" role="button">Get started today</a></p> -->
		</div>

		<!-- Example row of columns -->
		<div class="row" style="background: white; margin: 10px;">
			<a href="/projects/create" class="pull-right btn btn-default btn-sm">Add Project</a>
			<br>
			<div class="row container-fluid">
				<form method="post" action="{{ route('comments.store') }}">
					{{ csrf_field() }}
					<!-- hiddens -->
					<input type="hidden" name="commentable_type" value="Project">  
					<input type="hidden" name="commentable_id" value="{{ $project->id }}">  

					<div class="form-group">
						<label for="comment-content">Comment<span class="required">*</span></label>
						<textarea placeholder="Enter comment" id="comment-content" required name="body" rows="3" spellcheck="false" class="form-control autosize-target text-left"></textarea> 
					</div>

					<div class="form-group">
						<label for="comment-content">Proof of work done (Url/Photos) <span class="required">*</span></label>
						<textarea placeholder="Enter url o screeshots" id="comment-description" required name="url" rows="2" spellcheck="false" class="form-control autosize-target text-left"></textarea> 
					</div>


					<div class="form-group">
						<input type="submit" class="btn btn-primary" value="Submit">
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="col-sm-3 col-md-3 col-lg-3">
		<div class="sidebar-module">
			<h4>Actions</h4>
			<ol class="list-unstyled">
				<li><a href="/projects/{{ $project->id }}/edit">Edit</a></li>
				<li><a href="/projects/create">Create new project</a></li>
				<li><a href="/projects">My projects</a></li>
				<br>
				@if($project->user_id == Auth::user()->id)
					<li>
						<a href="#" onclick="
									var result = confirm('Are you sure you wish to delete this Company?');
									if(result){
										event.preventDefault();
										document.getElementById('delete-form').submit();
									}
								">Delete
						</a>
						<form id="delete-form" action="{{ route('projects.destroy', [$project->id]) }}"
								method="POST" style="display: none;">
								{{ csrf_field() }}
							<input type="hidden" name="_method" value="delete">
						</form>
					</li>
				@endif
			</ol>
		</div>
	</div>
</div>

@endsection
  