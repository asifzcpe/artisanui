@extends('artisanui.layouts')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Generate Artisan Files</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
                    
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/generate') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<label class="col-md-4 control-label">Select Project</label>
							<div class="col-md-6">
								<select class="form-control" name="project_directory">
                                    <option value="">Select Project Folder</option>
                                    @foreach($directories as $key=>$dir)
                                        @if ($key!='0')
                                            @if(Input::old('project_directory')==$key)
                                                <option selected="selected" value="{{ $key }}">{{ $dir }}</option>
                                            @else
                                                <option   value="{{ $key }}">{{ $dir }}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">File Type</label>
							<div class="col-md-6">
								<select name="file_type" class="form-control">
                                    <option value="">Select type</option>
                                    <option value="controller">Controller</option>
                                    <option value="model">Model</option>
                                    <option value="migration">Migration</option>
                                    <option value="serviceProvider">Service Provider</option>
                                    <option value="request">Request</option>
                                    <option value="command">Command</option>
                                    <option value="event">Event</option>

                                </select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">File Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="file_name" value="{{ old('file_name') }}">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Generate
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
