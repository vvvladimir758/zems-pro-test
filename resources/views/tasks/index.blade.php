@extends('layouts.app')
@push('styles')

  @vite('resources/sass/project/list.scss')

@endpush
@push('scripts')

  @vite('resources/js/task/list.js')

@endpush

@section('content')
<div id="taskList">
 <h4 class="h4 mt-5 mb-5 text-center">задачи</h4>

<task-list ref="task_list"></task-list>
 
        <vue-sidepanel 
            v-model="isOpened"
    		lock-scroll
    		side="top"
    		height="700px"
         >

        </vue-sidepanel>
        
</div>
@endsection