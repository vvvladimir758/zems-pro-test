@extends('layouts.app')
@push('styles')

  @vite('resources/sass/project/list.scss')

@endpush
@push('scripts')

  @vite('resources/js/task/task.js')

@endpush

@section('content')
<div id="task">

<task :data="{{$data}}" ref="task"></task-list>
 
        <vue-sidepanel 
            v-model="isOpened"
    		lock-scroll
    		side="top"
    		height="700px"
         >

        </vue-sidepanel>
        
</div>
@endsection