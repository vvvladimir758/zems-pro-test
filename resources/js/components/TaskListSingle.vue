<template>
  <h4 class="h4 mt-5 text-center">Задачи по проектам 
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" @click="showModal('addTask')" class="bi bi-plus-circle create-icon" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
</svg></h4>
  
 <div class="container mt-5">
<div class="row">
<template v-for="project in projects_" :key="project.id">

<b>{{project.title}}</b>
<hr>
 <table class="table">
  <thead>
    <tr>
      <th class="col-1">#</th>
      <th class="col-2">Название задачи</th>
      <th class="col-6">Описание</th>
      <th class="col-1 task-actions-column">
       действия
      </th>
    </tr>
  </thead>
  
  <tbody>
    <tr  v-for="task in project.tasks" :key="task.id">
      <th scope="row"></th>
      <td><a :href="'/task/' + task.id">{{task.title}}</a></td>
      <td>{{task.description}}</td>
      <td>
  <div class="container-fluid">
    <form class="d-flex task-actions-icons" role="edit">
    
     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" @click="editTask(task.id, task)" viewBox="0 0 16 16">
	  <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
	</svg>
	
	  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash"  @click="deleteTask(task.id)" viewBox="0 0 16 16">
	    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
	  </svg>
	

    </form>
  </div>
      </td>
    </tr>
  </tbody>
</table>
 


 
</template>
  
</div>
</div>

                <vue-sidepanel 
		            v-model="isOpenedAddTask"
		    		lock-scroll
		    		side="bottom"
		    		height="600px"
		         >
		         <AddTask 
		         :mode="taskModalMode" 
		         :project_id="this.$props.project_id" 
		         @modified="load" 
		         :task_id="this.editableTaskID"
		         :taskData="this.editableTask"
		         :projects="this.projects_"
		          />
		         </vue-sidepanel>
		         
		                 
		        <vue-sidepanel 
		            v-model="isOpenedDelTask"
		    		lock-scroll
		    		side="top"
		    		height="200px"
		         >
		          <h3 class="h3 alert mt-5">Вы действительно хотите удалить задачу </h3>
		          <div class="col-4 m-auto">
		          <button class="btn btn-danger m-1" @click="deleteTaskConfirm()"> да </button><button @click="closeModal()" class="btn btn-secondary m-1">отмена</button> 
		          </div>
		         </vue-sidepanel>
		         
		           <vue-sidepanel 
		            v-model="isOpenedDelTs"
		    		lock-scroll
		    		side="top"
		    		height="200px"
		         >
		          <h3 class="h3 alert mt-5">Вы действительно хотите удалить запись о потраченном времени </h3>
		          <div class="col-4 m-auto">
		          <button class="btn btn-danger m-1" @click="deleteTimeSpentConfirm()"> да </button><button @click="closeModal()" class="btn btn-secondary m-1">отмена</button> 
		          </div>
		         </vue-sidepanel>
		         
</template>

<script>
import AddTask from "../components/AddTask.vue";
import AddTimeSpent from "../components/AddTimeSpent.vue";

export default {
  name: "TaskListSingle",
  components:{ },
    props:['projects'],
  created() {},
  mounted() {
  console.log(this.$props.projects);
  this.projects_ = this.$props.projects;
  },
  data() {
    return {
    isOpenedAddTask:false,
    isOpenedAddTimeSpent:false,
    isOpenedDelTask:false,
    isOpenedDelTs:false,
    projects_: {},
    editableTask:{},
    editableTaskID:null,
    editableTs:{},
    editableTsID:null,
    project_id:null,
    taskModalMode: 'create',
    tsModalMode:   'create',
    
    };
  },

  methods: {
            showModal: function (varModal) {
	            
	             switch(varModal){
	             case 'addTask':
	             this.taskModalMode = 'create';
	             this.isOpenedAddTask = true;
	             this.editableTask = {};
	             break;
	             case 'editTask':
	             this.taskModalMode = 'edit';
	             this.isOpenedAddTask = true;
	             break;
	             case 'deleteTask':
	             this.isOpenedDelTask = true;
	             break;
	             case 'deleteProject':
	             this.isOpenedDelProject = true;
	             break;
	             case 'addTimeSpent':
	             this.isOpenedAddTimeSpent = true;
	             break;
	             case 'deleteTimeSpent':
	             this.isOpenedDelTs = true;
	             break;
	             
	             }
            },
            getImgUrl() {
			  return'/storage/'+ this.project.image.image_path ;
			},
			async load(){
	                await axios.get(`/vue_projects_data/`).then(({data})=>{
	                    this.projects_ = data;
	                    console.log(this.projects_.tasks);
	                    this.isLoaded = true;
	                }).catch(({ response })=>{
	                    console.error(response)
	                })
                },
            editTask(id, task){
	            this.editableTask = task;
	            this.editableTaskID = id;
	                     
	            this.showModal('editTask');
            
            },   
            deleteTask(id){
	            this.editableTaskID = id;
	            this.showModal('deleteTask');
            },
            deleteTaskConfirm(){          
                const config = {
                    headers: {
                        'content-type': 'application/json',
                        'X-CSRF-TOKEN': this.csrf,
                    }
                }
                
                let data = new FormData();                
                let appObj = this ;

                 var url = '/task/'+this.editableTaskID;
                  data.append('_method','delete');

                axios.post(url, data, config)
                    .then(function (result) {
                    
                   appObj.load();
                   appObj.closeModal();

                    })
                    .catch(function (err) {
                    console.log(err);

                    });
            },
            addTimeSpent(taskId){
	            this.editableTaskID = taskId;
	            this.editableTs={};
	            this.showModal('addTimeSpent');
            },
            editTimeSpent(id, ts){
	            this.editableTsID = id;
	            this.editableTs = ts;
	            this.tsModalMode = 'edit';
	            this.showModal('addTimeSpent');
            },
            deleteTimeSpent(id, ts){
	            this.editableTsID = id;
	            this.showModal('deleteTimeSpent');
            },
            deleteTimeSpentConfirm(){
            
               const config = {
                    headers: {
                        'content-type': 'application/json',
                        'X-CSRF-TOKEN': this.csrf,
                    }
                }
                
                let data = new FormData();                
                let appObj = this ;

                 var url = '/time_spent/'+this.editableTsID;
                  data.append('_method','delete');

                axios.post(url, data, config)
                    .then(function (result) {
                    
                   appObj.load();
                   appObj.closeModal();

                    })
                    .catch(function (err) {
                    console.log(err);

                    })
            
            },
            closeModal(){
              for(var i=0; i<document.getElementsByClassName('vsp-close__x').length; ++i)
              document.getElementsByClassName('vsp-close__x')[i].click();
            },
            
                   
  },
  watch: {
   },
  computed: {

  },
};
</script>

<style>
.task-actions-column{
min-width:60px;
}

.task-actions-icons svg{
color:#267b1c;
}

.add-time-btn{
width:100px;
margin-right:10px;
}   
</style>