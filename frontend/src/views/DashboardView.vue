<template>
  <div class="dashboard">
    <b-modal ref="modal-new-task" id="modal-new-task" centered hide-footer hide-header>
      <div class="modal-all">
        <div class="body-modal">
          <div class="group-inputs">
            <input
              v-model="nameTask"
              type="text"
              class="title"
              name="nameTask"
              placeholder="Nome da tarefa"
            />
            <input
              v-model="descTask"
              type="text"
              class="description"
              name="descTask"
              placeholder="Descrição"
            />
            <div class="date-venc">
              <svg
                width="20"
                height="22"
                viewBox="0 0 20 22"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M14 1V5M6 1V5M1 9H19M3 3H17C18.1046 3 19 3.89543 19 5V19C19 20.1046 18.1046 21 17 21H3C1.89543 21 1 20.1046 1 19V5C1 3.89543 1.89543 3 3 3Z"
                  stroke="#81858E"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                />
              </svg>
              <date-picker clearable class="date" :editable="false" placeholder="Data de vencimento"
                date-venc v-model="vencTask" value-type="YYYY-MM-DD" format="DD/MM/YYYY"></date-picker>
            </div>
          </div>
        </div>
        <div class="footer-modal">
          <button class="button btn-white" @click="modalNew">Cancelar</button>
          <button class="button btn-dark" @click="createTask(1)">Criar tarefa</button>
        </div>
      </div>
    </b-modal>

    <b-modal
      ref="modal-new-subtask"
      id="modal-new-subtask"
      centered
      hide-footer
      hide-header
    >
      <div class="modal-all">
        <div class="body-modal">
          <div class="group-inputs">
            <input
              v-model="nameTask"
              type="text"
              class="title"
              name="nameTask"
              placeholder="Nome da subtarefa"
            />
            <input
              v-model="descTask"
              type="text"
              class="description"
              name="descTask"
              placeholder="Descrição"
            />
          </div>
        </div>
        <div class="footer-modal">
          <button class="button btn-white" @click="modalSubNew">Cancelar</button>
          <button class="button btn-dark" @click="createSubTask(1)">Criar subtarefa</button>
        </div>
      </div>
    </b-modal>

    <b-modal ref="modal-edit-task" id="modal-edit-task" centered hide-footer hide-header>
      <div class="modal-all">
        <div class="body-modal">
          <div class="group-inputs">
            <input
              v-model="nameTask"
              type="text"
              class="title"
              name="nameTask"
              placeholder="Nome da tarefa"
            />
            <input
              v-model="descTask"
              type="text"
              class="description"
              name="descTask"
              placeholder="Descrição"
            />
            <div class="date-venc">
              <svg
                width="20"
                height="22"
                viewBox="0 0 20 22"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M14 1V5M6 1V5M1 9H19M3 3H17C18.1046 3 19 3.89543 19 5V19C19 20.1046 18.1046 21 17 21H3C1.89543 21 1 20.1046 1 19V5C1 3.89543 1.89543 3 3 3Z"
                  stroke="#81858E"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                />
              </svg>
              <date-picker clearable class="date" :editable="false" placeholder="Data de vencimento"
                date-venc v-model="vencTask" value-type="YYYY-MM-DD" format="DD/MM/YYYY"></date-picker>
            </div>
          </div>
        </div>
        <div class="footer-modal">
          <button class="button btn-white" @click="modalEdit">Cancelar</button>
          <button class="button btn-dark" @click="editTask(1)">Editar tarefa</button>
        </div>
      </div>
    </b-modal>

    <b-modal
      ref="modal-edit-subtask"
      id="modal-edit-subtask"
      centered
      hide-footer
      hide-header
    >
      <div class="modal-all">
        <div class="body-modal">
          <div class="group-inputs">
            <input
              v-model="nameTask"
              type="text"
              class="title"
              name="nameTask"
              placeholder="Nome da subtarefa"
            />
            <input
              v-model="descTask"
              type="text"
              class="description"
              name="descTask"
              placeholder="Descrição"
            />
          </div>
        </div>
        <div class="footer-modal">
          <button class="button btn-white" @click="modalSubEdit">Cancelar</button>
          <button class="button btn-dark" @click="editSubTask(1)">Editar subtarefa</button>
        </div>
      </div>
    </b-modal>

    <b-modal ref="modal-view-task" id="modal-view-task" centered hide-footer hide-header>
      <div class="modal-all">
        <div class="header-modal">
          <div :class="{'time': 'time', 'venc': isTaskVencida(vencTask)}">
            <svg
              width="20"
              height="22"
              viewBox="0 0 20 22"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M14 1V5M6 1V5M1 9H19M3 3H17C18.1046 3 19 3.89543 19 5V19C19 20.1046 18.1046 21 17 21H3C1.89543 21 1 20.1046 1 19V5C1 3.89543 1.89543 3 3 3Z"
                stroke="#009488"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <label v-if="!isTaskVencida(vencTask)" for="">No prazo</label>
            <label v-if="isTaskVencida(vencTask)" for="">Vencida</label>
          </div>
          <div class="functions">
            <span class="function" id="list-functions-task-1" @click="functionTask">
              <img src="@/assets/images/more.svg" alt="" />
              <div
                :class="{ 'functions-popover': true, show: showFunctionTask }"
                class=""
              >
                <div class="item">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="19"
                    height="19"
                    viewBox="0 0 19 19"
                    fill="none"
                  >
                    <path
                      d="M7.79035 10.3557C8.15746 10.847 8.62582 11.2535 9.16367 11.5476C9.70152 11.8418 10.2963 12.0167 10.9076 12.0605C11.5189 12.1043 12.1325 12.016 12.7067 11.8016C13.281 11.5872 13.8024 11.2516 14.2357 10.8178L16.8002 8.2507C17.5788 7.44378 18.0096 6.36304 17.9998 5.24125C17.9901 4.11946 17.5406 3.04638 16.7481 2.25312C15.9557 1.45987 14.8837 1.00991 13.763 1.00016C12.6424 0.990414 11.5627 1.42166 10.7566 2.201L9.28629 3.66423M11.2096 8.64431C10.8425 8.15304 10.3742 7.74654 9.83633 7.4524C9.29848 7.15825 8.70372 6.98333 8.0924 6.9395C7.48108 6.89568 6.86749 6.98397 6.29326 7.19839C5.71902 7.41282 5.19757 7.74835 4.76427 8.18224L2.1998 10.7493C1.42123 11.5562 0.990423 12.637 1.00016 13.7588C1.0099 14.8805 1.4594 15.9536 2.25186 16.7469C3.04432 17.5401 4.11632 17.9901 5.23698 17.9998C6.35765 18.0096 7.4373 17.5783 8.24341 16.799L9.70516 15.3358"
                      stroke="black"
                      stroke-width="1.5"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                  </svg>
                  <label @click="copyLink(idTask, tokenTask)">Copiar link da tarefa</label>
                </div>
                <div @click="createTask(1)" class="item">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="19"
                    height="19"
                    viewBox="0 0 19 19"
                    fill="none"
                  >
                    <path
                      d="M3.55 12.05H2.7C2.24913 12.05 1.81673 11.8709 1.49792 11.5521C1.17911 11.2333 1 10.8009 1 10.35V2.7C1 2.24913 1.17911 1.81673 1.49792 1.49792C1.81673 1.17911 2.24913 1 2.7 1H10.35C10.8009 1 11.2333 1.17911 11.5521 1.49792C11.8709 1.81673 12.05 2.24913 12.05 2.7V3.55M8.65 6.95H16.3C17.2389 6.95 18 7.71112 18 8.65V16.3C18 17.2389 17.2389 18 16.3 18H8.65C7.71112 18 6.95 17.2389 6.95 16.3V8.65C6.95 7.71112 7.71112 6.95 8.65 6.95Z"
                      stroke="black"
                      stroke-width="1.5"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                  </svg>
                  <label for="">Duplicar tarefa</label>
                </div>
                <div class="item">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="19"
                    height="19"
                    viewBox="0 0 19 19"
                    fill="none"
                  >
                    <path
                      d="M4.4 6.95V1H14.6V6.95M4.4 14.6H2.7C2.24913 14.6 1.81673 14.4209 1.49792 14.1021C1.17911 13.7833 1 13.3509 1 12.9V8.65C1 8.19913 1.17911 7.76673 1.49792 7.44792C1.81673 7.12911 2.24913 6.95 2.7 6.95H16.3C16.7509 6.95 17.1833 7.12911 17.5021 7.44792C17.8209 7.76673 18 8.19913 18 8.65V12.9C18 13.3509 17.8209 13.7833 17.5021 14.1021C17.1833 14.4209 16.7509 14.6 16.3 14.6H14.6M4.4 11.2H14.6V18H4.4V11.2Z"
                      stroke="black"
                      stroke-width="1.5"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                  </svg>
                  <label for="">Imprimir tarefa</label>
                </div>
                <div class="item trash">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="17"
                    height="19"
                    viewBox="0 0 17 19"
                    fill="none"
                  >
                    <path
                      d="M1 4.4H2.66667M2.66667 4.4H16M2.66667 4.4V16.3C2.66667 16.7509 2.84226 17.1833 3.15482 17.5021C3.46738 17.8209 3.89131 18 4.33333 18H12.6667C13.1087 18 13.5326 17.8209 13.8452 17.5021C14.1577 17.1833 14.3333 16.7509 14.3333 16.3V4.4M5.16667 4.4V2.7C5.16667 2.24913 5.34226 1.81673 5.65482 1.49792C5.96738 1.17911 6.39131 1 6.83333 1H10.1667C10.6087 1 11.0326 1.17911 11.3452 1.49792C11.6577 1.81673 11.8333 2.24913 11.8333 2.7V4.4M6.83333 8.65V13.75M10.1667 8.65V13.75"
                      stroke="#D31408"
                      stroke-width="1.5"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                  </svg>
                  <label @click="deleteTask(idTask)" >Excluir tarefa</label>
                </div>
              </div>
            </span>
            <span class="function" @click="modalView(1)">
              <img src="@/assets/images/close.svg" alt="" />
            </span>
          </div>
        </div>
        <div class="body-modal view">
          <div class="right">
            <div class="task">
              <div class="check-task">
                <input type="checkbox" :id="'task-view-'+idTask" hidden />
                <label class="checkbox" :for="'task-view-'+idTask">
                  <span class="check">
                    <img src="@/assets/images/check.svg" alt="" />
                  </span>
                </label>
              </div>
              <div class="info-task">
                <label class="title-task">{{nameTask}}</label>
                <p class="description-task">
                  {{descTask}}
                </p>
                <div v-if="subtasksExist(idTask)" class="subtask">
                  <label class="title"> Subtarefas </label>
                  <div class="list-subtasks">
                    <div v-for="subtaskView in getSubtasks(idTask)" :key="subtaskView.id"  class="box-subtask">
                      <div class="check-task">
                        <input type="checkbox" :id="'task-view-'+idTask+'-sub-'+ subtaskView.id" hidden />
                        <label class="checkbox" :for="'task-view-'+idTask+'-sub-'+ subtaskView.id">
                          <span class="check">
                            <img src="@/assets/images/check.svg" alt="" />
                          </span>
                        </label>
                      </div>
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
            <div class="info-task">
              <label class="title">Modificado em</label>
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

                {{formatDate(1, updatedTask)}}
              </label>
            </div>
            <div class="info-task">
              <label class="title">ID da tarefa</label>
              <label class="info"> {{tokenTask}} </label>
            </div>
          </div>
        </div>
      </div>
    </b-modal>

    <header class="header">
      <nav class="navbar">
        <div class="icon">
          <img src="@/assets/images/icon.png" alt="" />
        </div>
        <div class="functions">
          <span
            @click="createTask(0)"
            class="function"
            v-b-tooltip.hover
            title="Criar tarefa"
          >
            <img src="@/assets/images/add.svg" alt="" />
          </span>
          <span class="function">
            <img src="@/assets/images/help.svg" alt="" />
          </span>
          <span class="function">
            <img src="@/assets/images/alert.svg" alt="" />
          </span>
          <span @click="logout" v-b-tooltip.hover class="user-profile">
            <label for="">L</label>
          </span>
        </div>
      </nav>
    </header>

    <main class="content">
      <section class="sidebar">
        <div @click="filteredTasks(0)" class="item">
          <img src="@/assets/images/inbox.svg" alt="" />
          <label for="">Entrada</label>
        </div>
        <div @click="filteredTasks(1)" class="item">
          <img src="@/assets/images/tasks.svg" alt="" />
          <label for="">Tarefas de hoje</label>
        </div>
        <div @click="filteredTasks(2)" class="item">
          <img src="@/assets/images/warning.svg" alt="" />
          <label for="">Vencidos</label>
        </div>
      </section>
      <section class="base">
        <div class="title">
          <label for="">Entrada</label>
        </div>
        <div class="boxs-tasks">
          <div class="task" v-for="task in listTask" :key="task.id">
            <div class="top-task">
              <div class="check-task">
                <input type="checkbox" :id="'task-'+task.id" hidden />
                <label class="checkbox" :for="'task-'+task.id">
                  <span class="check">
                    <img src="@/assets/images/check.svg" alt="" />
                  </span>
                </label>
              </div>
              <div class="info-task">
                <label class="title-task" @click="modalView(0, task)">{{task.titulo}}</label>
                <div class="extra-desc">
                  <p class="description-task">
                    {{task.descricao}}
                  </p>
                  <div class="functions-task">
                    <span
                      @click="editTask(0, task)"
                      class="function"
                      v-b-tooltip.hover
                      title="Editar tarefa"
                    >
                      <svg
                        width="18"
                        height="18"
                        viewBox="0 0 18 18"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          d="M13.1038 1.66848C13.3158 1.45654 13.5674 1.28843 13.8443 1.17373C14.1212 1.05903 14.418 1 14.7177 1C15.0174 1 15.3142 1.05903 15.5911 1.17373C15.868 1.28843 16.1196 1.45654 16.3315 1.66848C16.5435 1.88041 16.7116 2.13201 16.8263 2.40891C16.941 2.68582 17 2.9826 17 3.28232C17 3.58204 16.941 3.87882 16.8263 4.15573C16.7116 4.43263 16.5435 4.68423 16.3315 4.89617L5.43807 15.7896L1 17L2.21038 12.5619L13.1038 1.66848Z"
                          stroke="#81858E"
                          stroke-width="1.3"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        />
                      </svg>
                    </span>
                    <span class="function" v-b-tooltip.hover title="Definir vencimento">
                      <svg
                        width="20"
                        height="22"
                        viewBox="0 0 20 22"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          d="M14 1V5M6 1V5M1 9H19M3 3H17C18.1046 3 19 3.89543 19 5V19C19 20.1046 18.1046 21 17 21H3C1.89543 21 1 20.1046 1 19V5C1 3.89543 1.89543 3 3 3Z"
                          stroke="#81858E"
                          stroke-width="2"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        />
                      </svg>
                    </span>
                    <span @click="deleteTask(task.id)" class="function" v-b-tooltip.hover title="Excluir tarefa">
                      <svg
                        width="17"
                        height="19"
                        viewBox="0 0 17 19"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          d="M1 4.4H2.66667M2.66667 4.4H16M2.66667 4.4V16.3C2.66667 16.7509 2.84226 17.1833 3.15482 17.5021C3.46738 17.8209 3.89131 18 4.33333 18H12.6667C13.1087 18 13.5326 17.8209 13.8452 17.5021C14.1577 17.1833 14.3333 16.7509 14.3333 16.3V4.4M5.16667 4.4V2.7C5.16667 2.24913 5.34226 1.81673 5.65482 1.49792C5.96738 1.17911 6.39131 1 6.83333 1H10.1667C10.6087 1 11.0326 1.17911 11.3452 1.49792C11.6577 1.81673 11.8333 2.24913 11.8333 2.7V4.4M6.83333 8.65V13.75M10.1667 8.65V13.75"
                          stroke="#81858E"
                          stroke-width="1.5"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        />
                      </svg>
                    </span>
                  </div>
                </div>
                <div class="date-count">
                  <div :class="{ 'date': 'date' , 'danger': isTaskVencida(task.data_vencimento) }">
                    <svg
                      width="20"
                      height="22"
                      viewBox="0 0 20 22"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M14 1V5M6 1V5M1 9H19M3 3H17C18.1046 3 19 3.89543 19 5V19C19 20.1046 18.1046 21 17 21H3C1.89543 21 1 20.1046 1 19V5C1 3.89543 1.89543 3 3 3Z"
                        stroke="#D31408"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                    <label for="">{{formatDate(0, task.data_vencimento)}}</label>
                  </div>
                  <div v-if="subtasksExist(task.id)" class="count"></div>
                </div>
              </div>
            </div>
            <div v-if="subtasksExist(task.id)" class="list-tasks">
              <div v-for="subtask in getSubtasks(task.id)" :key="subtask.id" class="subtask">
                <div class="check-task">
                  <input type="checkbox" :id="'task-'+task.id+'-sub-' + subtask.id" hidden />
                  <label class="checkbox" :for="'task-'+task.id+'-sub-' + subtask.id">
                    <span class="check">
                      <img src="@/assets/images/check.svg" alt="" />
                    </span>
                  </label>
                </div>
                <div class="functions-sub">
                  <label class="title-task" :for="'task-'+task.id+'-sub-' + subtask.id">{{ subtask.titulo }}</label>
                  <div class="functions-task">
                    <span
                      @click="editSubTask(0, subtask)"
                      class="function"
                      v-b-tooltip.hover
                      title="Editar subtarefa"
                    >
                      <svg
                        width="18"
                        height="18"
                        viewBox="0 0 18 18"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          d="M13.1038 1.66848C13.3158 1.45654 13.5674 1.28843 13.8443 1.17373C14.1212 1.05903 14.418 1 14.7177 1C15.0174 1 15.3142 1.05903 15.5911 1.17373C15.868 1.28843 16.1196 1.45654 16.3315 1.66848C16.5435 1.88041 16.7116 2.13201 16.8263 2.40891C16.941 2.68582 17 2.9826 17 3.28232C17 3.58204 16.941 3.87882 16.8263 4.15573C16.7116 4.43263 16.5435 4.68423 16.3315 4.89617L5.43807 15.7896L1 17L2.21038 12.5619L13.1038 1.66848Z"
                          stroke="#81858E"
                          stroke-width="1.3"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        />
                      </svg>
                    </span>
                    <span @click="deleteSubTask(subtask.id)" class="function" v-b-tooltip.hover title="Excluir subtarefa">
                      <svg
                        width="17"
                        height="19"
                        viewBox="0 0 17 19"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          d="M1 4.4H2.66667M2.66667 4.4H16M2.66667 4.4V16.3C2.66667 16.7509 2.84226 17.1833 3.15482 17.5021C3.46738 17.8209 3.89131 18 4.33333 18H12.6667C13.1087 18 13.5326 17.8209 13.8452 17.5021C14.1577 17.1833 14.3333 16.7509 14.3333 16.3V4.4M5.16667 4.4V2.7C5.16667 2.24913 5.34226 1.81673 5.65482 1.49792C5.96738 1.17911 6.39131 1 6.83333 1H10.1667C10.6087 1 11.0326 1.17911 11.3452 1.49792C11.6577 1.81673 11.8333 2.24913 11.8333 2.7V4.4M6.83333 8.65V13.75M10.1667 8.65V13.75"
                          stroke="#81858E"
                          stroke-width="1.5"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        />
                      </svg>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div v-if="!isTaskVencida(task.data_vencimento)" class="add-tasks">
              <span class="btn-add" v-b-modal="'modal-new-subtask'">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="16"
                  height="16"
                  viewBox="0 0 16 16"
                  fill="none"
                >
                  <path
                    d="M8.06306 1V15M1 8H15.1261"
                    stroke="#81858E"
                    stroke-width="1.3"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                </svg>
                <label @click="createSubTask(0, task.id)">Criar subtarefa</label>
              </span>
            </div>
          </div>

        </div>
      </section>
    </main>
  </div>
</template>

<script>
export default {
  beforeRouteEnter(to, from, next) {
    const user = localStorage.getItem('userLogin');

    if (user == '' || user == null || user == undefined) {
      next('/'); // Redireciona para a página inicial
    } else {
      next(); // Continua para a rota da Dashboard
    }
  },
  data() {
    return {
      userAuth: '',
      showFunctionTask: false,
      currentDate: new Date().toISOString().split('T')[0],
      listTask: [],
      listSubTask: [],
      listViewSubTask: [],
      tasks: '',
      idTask: '',
      tokenTask: '',
      nameTask: '',
      descTask: '',
      vencTask: '',
      createdTask: '',
      updatedTask: ''
    };
  },
  methods: {
    load(){
      this.$http.get('/task/' + this.userAuth).then(response => { this.listTask = response.data;})
      this.$http.get('/subtask/' + this.userAuth).then(response => { this.listSubTask = response.data;})
    },
    logout(){
      localStorage.removeItem('userLogin');
      this.$router.push('/login');
    },
    clean(){
      this.idTask = '';
      this.tokenTask = '';
      this.nameTask = '';
      this.descTask = '';
      this.vencTask = '';
      this.createdTask = '';
      this.updatedTask = '';
    },
    showAlert(type, msg) {
      this.$swal({
        text: msg,
        icon: type,
        confirmButtonText: 'Confirmar'
      });

      this.load();
    },
    filteredTasks(type) {
      console.log(type)
      if(type == 1 || type == 2){
        /* Retorna das tarefas filtradas */
        this.$http.get('/task/filter/' + type).then(response => { 
          
          if(response.data.status == 'success'){
            this.listTask = response.data.filter;
          }else{
            this.showAlert(response.data.status, response.data.msg);
          }
        })
      }else{
        this.load();
      }

      this.clean();
    },
    modalNew() {
      this.$refs["modal-new-task"].hide();
    },
    modalSubNew() {
      this.$refs["modal-new-subtask"].hide();
    },
    modalEdit() {
      this.$refs["modal-edit-task"].hide();
    },
    modalSubEdit() {
      this.$refs["modal-edit-subtask"].hide();
    },
    modalView(type, task = null) {
      if(type == 0){
        this.clean();

        this.idTask = task.id;
        this.nameTask = task.titulo;
        this.descTask = task.descricao;
        this.tokenTask = task.token_tarefa;
        this.vencTask = task.data_vencimento;
        this.createdTask =  task.created_at;
        this.updatedTask =   task.updated_at;

        this.$refs["modal-view-task"].show();
      }else{
        this.$refs["modal-view-task"].hide();
      }
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
    functionTask() {
      this.showFunctionTask = !this.showFunctionTask;
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

      dataAtual.setHours(0, 0, 0, 0);
      
      return dataAtual > dataVenc; 

    },
    copyLink(id, token) {

      const url = `${this.urlHOST}/view/${id}/${token}`

      if (!navigator.clipboard) {
        url.execCommand("copy");
      } else {
          navigator.clipboard.writeText(url);
      }

      this.showAlert('success', 'O link da tarefa foi copiado!');

    },
    createTask(type) {

      if(type == 0){
        this.clean();
        this.$refs["modal-new-task"].show();
      }else{

      var data = {
        id_usuario: this.userAuth,
        token_tarefa: 'asdwdfsd',
        titulo: this.nameTask,
        descricao: this.descTask,
        data_vencimento: this.vencTask
      };
      
      this.$http.post("task/create", data)
        .then(response => {

          this.clean();

          if(response.data.status == 'success'){
            this.modalNew();
          }

          this.showAlert(response.data.status, response.data.msg);
        })
        .catch(error => {
          console.error(error);
        });
      }
    },
    deleteTask(task){
      this.$http.delete("task/delete/" + task)
      .then(response => { 
        this.showAlert(response.data.status, response.data.msg);
      })
    },
    editTask(type, task = null){
        
      if(type == 0){
        
        this.nameTask = task.titulo;
        this.descTask = task.descricao;
        this.vencTask = task.data_vencimento;
        this.idTask   = task.id;

        this.$refs["modal-edit-task"].show();
      }else{

        var data = {
          token_tarefa: 'asdwdfsd',
          titulo: this.nameTask,
          descricao: this.descTask,
          data_vencimento: this.vencTask
        };
        
        this.$http.put("task/update/"+ this.idTask, data)
          .then(response => {
  
            this.clean();

            if(response.data.status == 'success'){
              this.modalEdit();
            }

            this.showAlert(response.data.status, response.data.msg);
          })
          .catch(error => {
            console.error(error);
          });
      }
    },
    createSubTask(type, task = null){
      
      if(type == 0){
        this.clean();
        this.idTask = task;
        this.$refs["modal-new-subtask"].show();
      }else{
        var data = {
        id_tarefa: this.idTask,
        titulo: this.nameTask,
        descricao: this.descTask,
      };
      
      this.$http.post("subtask/create", data)
        .then(response => {

          this.clean();

          if(response.data.status == 'success'){
            this.modalSubNew();
          }

          this.showAlert(response.data.status, response.data.msg);

        })
        .catch(error => {
          console.error(error);
        });
      }
      
    },
    deleteSubTask(task){
      this.$http.delete("subtask/delete/" + task)
      .then(response => { 
        this.showAlert(response.data.status, response.data.msg);
      })
    },
    editSubTask(type, task = null){
        
      if(type == 0){
        this.clean();
        this.nameTask = task.titulo;
        this.descTask = task.descricao;
        this.idTask   = task.id;

        this.$refs["modal-edit-subtask"].show();
      }else{

        var data = {
          token_tarefa: 'asdwdfsd',
          titulo: this.nameTask,
          descricao: this.descTask,
          data_vencimento: this.vencTask
        };
        
        this.$http.put("subtask/update/"+ this.idTask, data)
          .then(response => {
  
            this.clean();

            if(response.data.status == 'success'){
              this.modalSubEdit();
            }
            
            this.showAlert(response.data.status, response.data.msg);

          })
          .catch(error => {
            console.error(error);
          });
      }
    },
  },
  created(){
    this.urlBase = this.$root.urlBase;
    this.userAuth = localStorage.getItem('userLogin');
    this.load();
  }
};
</script>
