<template>
  <div class="viewTask">
    <div class="view">
      <div class="modal-all">
        <div class="body-modal view">
          <div class="right">
            <div class="task">
              <div class="info-task">
                <label class="title-task">{{nameTask}}</label>
                <p class="description-task">
                  {{descTask}}
                </p>
                <div v-if="subtasksExist(idTask)" class="subtask">
                  <label class="title"> Subtarefas </label>
                  <div class="list-subtasks">
                    <div v-for="subtaskView in getSubtasks(idTask)" :key="subtaskView.id"  class="box-subtask">
                      <label>{{subtaskView.titulo}}</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="left">
            <div class="info-task">
              <label class="title">Criado em</label>
              <label class="info">
                <svg
                  width="20"
                  height="22"
                  viewBox="0 0 20 22"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M14 1V5M6 1V5M1 9H19M3 3H17C18.1046 3 19 3.89543 19 5V19C19 20.1046 18.1046 21 17 21H3C1.89543 21 1 20.1046 1 19V5C1 3.89543 1.89543 3 3 3Z"
                    stroke="#000"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                </svg>

                {{formatDate(1, createdTask)}}
              </label>
            </div>
            <div class="info-task">
              <label class="title">Data de vencimento</label>
              <label :class="{ 'info': 'info', 'date': 'date' , 'venc': isTaskVencida(vencTask) }">
                <svg
                  width="20"
                  height="22"
                  viewBox="0 0 20 22"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M14 1V5M6 1V5M1 9H19M3 3H17C18.1046 3 19 3.89543 19 5V19C19 20.1046 18.1046 21 17 21H3C1.89543 21 1 20.1046 1 19V5C1 3.89543 1.89543 3 3 3Z"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                </svg>

                {{formatDate(0, vencTask)}}
              </label>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
export default {
  data() {
    return {
      listTask: [],
      listSubTask: [],
      listViewSubTask: [],
      tasks: '',
      idTask: '',
      nameTask: '',
      descTask: '',
      vencTask: '',
      createdTask: ''
    };
  },
  methods: {
    clean(){
      this.idTask = '';
      this.tokenTask = '';
      this.nameTask = '';
      this.descTask = '';
      this.vencTask = '';
      this.createdTask = '';
      this.updatedTask = '';
    },
    formatDate(type, date){
      if (!date) {
        return ''; // Retorna uma string vazia se não houver data ou hora
      }

      const dateFormat = new Date(date);

      if(type == 0){
        return `${dateFormat.getDate().toString().padStart(2, '0')}/${(dateFormat.getMonth() + 1).toString().padStart(2, '0')}/${dateFormat.getFullYear()}`;
      }else{

        return `${dateFormat.getDate().toString().padStart(2, '0')}/${(dateFormat.getMonth() + 1).toString().padStart(2, '0')}/${dateFormat.getFullYear()} às ${dateFormat.getHours().toString().padStart(2, '0')}:${dateFormat.getMinutes().toString().padStart(2, '0')}`;
      }

    },
    subtasksExist(idTask) {
      return this.listSubTask.some(subtask => subtask.id_tarefa === idTask);
    },
    getSubtasks(idTask) {
      return this.listSubTask.filter(subtask => subtask.id_tarefa === idTask);
    },
    isTaskVencida(task) {

      const dataAtual = new Date();
      const dataVenc = new Date(task);

      return dataAtual > dataVenc;
    }
  },
  mounted() {
    this.$http.get('view/'+this.$route.params.id+'/'+ this.$route.params.token).then(response => { 

      this.idTask = response.data.id;
      this.nameTask = response.data.titulo;
      this.descTask = response.data.descricao;
      this.vencTask = response.data.data_vencimento;
      this.createdTask = response.data.created_at;
      
    })

    this.$http.get('/subtask').then(response => { this.listSubTask = response.data;})
   
  }
};
</script>
