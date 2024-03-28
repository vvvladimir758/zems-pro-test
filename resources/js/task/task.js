import { createApp } from "vue";
import { createStore } from 'vuex';
import TaskListSingle from "../components/TaskListSingle.vue";
import AddTask from "../components/AddTask.vue";
import { VueSidePanel } from 'vue3-side-panel';
import 'vue3-side-panel/dist/vue3-side-panel.css';


export const store = createStore({
  state() {
    return {
      project:{},
      reload:false,
      isOpened:false,
    }
  },
  mutations: {
	reset(){
		this.state.realod = false;
		this.state.project = {};
	},
	
  }
})

const taskList = createApp({  
	data() {
    return { 
		isOpened:false,
		 }
    },
    store: store,
	methods: {
	    showModal() {
		 this.isOpened = true;
	     store.state.isOpened = true;
	    },
	     increment() {
	      store.commit('increment')
	    },
    },
    watch: {
   '$store.state.isOpened' : function() {
     this.isOpened = store.state.isOpened;
     },
   },
    computed: {
		isOpenedModal(){
			return store.state.isOpened;
		}
  }
    
    
  
  });
  

taskList.component('task-list', TaskListSingle);
taskList.component('vue-sidepanel',VueSidePanel);
taskList.component('AddTask',AddTask);


taskList.use(store);
taskList.mount("#taskList");
