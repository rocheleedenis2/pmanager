@extends('layouts.app')

@section('content')

    <div class="row col-sm-9 col-md-9 col-lg-9 pull-left">
        <!-- Example row of columns -->
        <div class="row col-sm-12 col-md-12 col-lg-12" style="background: white; margin: 10px;">
            <form method="post" action="{{ route('projects.update', [$project->id]) }}">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="put"> 
                <div class="form-group">
                    <label for="project-name">Name <span class="required">*</span></label>
                    <input type="" placeholder="Enter name" id="project-name" required name="name" spellcheck="false" class="form-control" value="{{ $project->name }}">
                </div> 

                <div class="form-group">
                    <label for="project-description">Description <span class="required">*</span></label>
                    <textarea placeholder="Enter description" id="project-description" required name="description" rows="5" spellcheck="false" class="form-control autosize-target text-left">{{ $project->description }}</textarea> 
                </div> 

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
            </form>  
        </div>
    </div>

    <div class="col-sm-3 col-md-3 col-lg-3 pull-right">

        <div class="sidebar-module">
            <h4>Actions</h4>
            <ol class="list-unstyled">
                <li><a href="/projects/{{ $project->id }}/edit">View projects</a></li>
                <li><a href="#">All projects</a></li>
            </ol>
        </div>
    </div>

@endsection
    