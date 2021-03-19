@extends('beautymail::templates.widgets')

@section('content')

	@include('beautymail::templates.widgets.newfeatureStart')
        <h4 class="secondary"><strong>Name</strong></h4>
		<p>{{$name}}</p>
		<h4 class="secondary"><strong>Day Of Birth</strong></h4>
		<p>{{$dob}}</p>
        <h4 class="secondary"><strong>Address</strong></h4>
		<p>{{$address}}</p>
        <h4 class="secondary"><strong>Mobile number</strong></h4>
		<p>{{$mobile}}</p>
        <h4 class="secondary"><strong>Course Name</strong></h4>
		<p>{{$course_name}}</p>
        <h4 class="secondary"><strong>Course start date</strong></h4>
		<p>{{$start_date}}</p>
        <h4 class="secondary"><strong>Course end date</strong></h4>
		<p>{{$end_date}}</p>
        <h4 class="secondary"><strong>Lesson start time</strong></h4>
		<p>{{$course_start_time}}</p>
        <h4 class="secondary"><strong>Lesson end time</strong></h4>
		<p>{{$end_time}}</p>
	@include('beautymail::templates.widgets.newfeatureEnd')

@stop