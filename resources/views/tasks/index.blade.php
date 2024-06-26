@extends('layouts.app')
@push('styles')

  @vite('resources/sass/project/list.scss')

@endpush
@push('scripts')

  @vite('resources/js/task/list.js')

@endpush

@section('content')
<div id="taskList">

<task-list :projects="{{$projects}}" ref="task_list"></task-list>
 
        <vue-sidepanel 
            v-model="isOpened"
    		lock-scroll
    		side="top"
    		height="700px"
         >

        </vue-sidepanel>
        
</div>
@endsection