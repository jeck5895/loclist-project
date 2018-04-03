<template>
    <table class="table table-borderless table-striped">
        <thead>
            <tr>
                <th>No performed action in:</th>
                <th>Recently Added</th>
                <th>7 days</th>
                <th>1 month</th>
                <th>3 months</th>
                <th>6 months</th>
                <th>1 Year </th>
            </tr>
        </thead>
        <tbody>
            <tr v-if="isLoading">
                <td colspan="11" class="text-center">
                    <div v-if="isLoading" class="card-body">
                        <div class="img-loading-container">
                            <img src="/images/spinner.gif" class="img-sm">
                        </div>
                    </div>
                </td>
            </tr>
            <tr v-else-if="pending_tasks.data == 0">
                <td colspan="6" class="text-center">
                    No data to show...
                </td>
            </tr>

            <template v-else> 
                <tr v-for="(pending_task, index) in pending_tasks" :key="index">
                    <td style="vertical-align: middle;">
                            {{ pending_task.task_name }} 
                            &nbsp;
                    </td>
                    <td style="vertical-align: middle;">
                        <a v-if="pending_task.recent != 0" @click.prevent="showTable({scope: pending_task.task_id, range: 'RECENT'})" href="#">  
                            {{ pending_task.recent }} 
                            &nbsp;<small><span class="fa fa-external-link"></span></small>
                        </a>  
                        <span v-else>{{ pending_task.recent }}</span>
                    </td>
                    <td style="vertical-align: middle;">
                        <a v-if="pending_task.seven_days != 0" @click.prevent="showTable({scope: pending_task.task_id, range: 'SEVEN_DAYS'})" href="#">  
                            {{ pending_task.seven_days }} 
                            &nbsp;<small><span class="fa fa-external-link"></span></small>
                        </a>  
                        <span v-else>{{ pending_task.seven_days }}</span>
                    </td>
                    <td style="vertical-align: middle;">
                        <a v-if="pending_task.one_month != 0" @click.prevent="showTable({scope:pending_task.task_id, range: 'ONE_MONTH'})" href="#">  
                            {{ pending_task.one_month }}
                            &nbsp;<small><span class="fa fa-external-link"></span></small>
                        </a>
                        <span v-else>{{ pending_task.one_month }}</span>
                    </td>
                    <td style="vertical-align: middle;">
                        <a v-if="pending_task.three_months != 0" @click.prevent="showTable({scope: pending_task.task_id, range: 'THREE_MONTHS'})" href="#">  
                            {{ pending_task.three_months }}
                            &nbsp;<small><span class="fa fa-external-link"></span></small>
                        </a>
                        <span v-else>{{ pending_task.three_months }}</span>
                    </td>
                    <td style="vertical-align: middle;">
                        <a v-if="pending_task.six_months != 0" @click.prevent="showTable({scope: pending_task.task_id, range: 'SIX_MONTHS'})" href="#">  
                            {{ pending_task.six_months }}
                            &nbsp;<small><span class="fa fa-external-link"></span></small>
                        </a>
                        <span v-else>{{ pending_task.six_months }}</span>
                    </td>
                    <td style="vertical-align: middle;">
                        <a v-if="pending_task.one_year" @click.prevent="showTable({scope: pending_task.task_id, range: 'ONE_YEAR'})" href="#">  
                            {{ pending_task.one_year }}
                            &nbsp;<small><span class="fa fa-external-link"></span></small>
                        </a>
                        <span v-else>{{ pending_task.one_year }}</span>
                    </td>
                </tr>
            </template>
        </tbody>
    </table>

</template>

<script>
    export default {
        computed: {
            pending_tasks() {
                return this.$store.getters.getPendingTasks;
            },
            isLoading() {
                return this.$store.getters.getPendingTasksLoadingState;
            }
        },
        methods: {
            loadPendingTasks() {
                this.$store.dispatch(`loadPendingTasks`);
            },
            showTable(params) {
                let modal_title = null;
                let table_type = null;
                let parameters = null;

                if(params.scope == 1){
                    if(params.range == "RECENT"){
                        modal_title = "LIST OF RECENTLY ADDED CLIENTS WITH NO PERFORMED PRE-CALL";
                        table_type = "SHOW_CALL_TASKS_RECENT";
                        parameters = {
                            scope: 'for-calls',
                            range: 0,
                            task_id: params.scope
                        };
                    }
                    else if(params.range == "SEVEN_DAYS"){
                        modal_title = "LIST OF CLIENTS WITH NO PERFORMED PRE-CALL IN 7 DAYS";
                        table_type = "SHOW_CALL_TASKS_SEVEN_DAYS";
                        parameters = {
                            scope: 'for-calls',
                            range: 7,
                            task_id: params.scope
                        };
                    }
                    else if(params.range == "ONE_MONTH"){
                        modal_title = "LIST OF CLIENTS WITH NO PERFORMED PRE-CALL IN 1 MONTH ";
                        table_type = "SHOW_CALL_TASKS_ONE_MONTH";
                        parameters = {
                            scope: 'for-calls',
                            range: 30,
                            task_id: params.scope
                        };
                    }
                    else if(params.range == "THREE_MONTHS"){
                        modal_title = "LIST OF CLIENTS WITH NO PERFORMED PRE-CALL IN 3 MONTHS ";
                        table_type = "SHOW_CALL_TASKS_THREE_MONTHS";
                        parameters = {
                            scope: 'for_calls',
                            range: 90,
                            task_id: params.scope
                        };
                    }
                    else if(params.range == "SIX_MONTHS"){
                        modal_title = "LIST OF CLIENTS WITH NO PERFORMED PRE-CALL IN 6 MONTHS";
                        table_type = "SHOW_CALL_TASKS_SIX_MONTHS";
                        parameters = {
                            scope: 'for-calls',
                            range: 180,
                            task_id: params.scope
                        };
                    }
                    else if(params.range == "ONE_YEAR") {
                        modal_title = "LIST OF CLIENTS WITH NO PERFORMED PRE-CALL IN 1 YEAR";
                        table_type = "SHOW_CALL_TASKS_ONE_YEAR";
                        parameters = {
                            scope: 'for-calls',
                            range: 365,
                            task_id: params.scope
                        };
                    }
                    else {
                        
                    }
                }
                if(params.scope == 2){ //ID of status in overall_statuses table
                    if(params.range == "RECENT"){
                        modal_title = "LIST OF RECENTLY ADDED CLIENTS WITH NO PERFORMED SATURATION";
                        table_type = "SHOW_SATURATION_TASKS_RECENT";
                        parameters = {
                            scope: 'for-saturations',
                            range: 0,
                            task_id: params.scope
                        };
                    }
                    else if(params.range == "SEVEN_DAYS"){
                        modal_title = "LIST OF CLIENTS WITH NO PERFORMED SATURATION IN 7 DAYS";
                        table_type = "SHOW_SATURATION_TASKS_SEVEN_DAYS";
                        parameters = {
                            scope: 'for-saturations',
                            range: 7,
                            task_id: params.scope
                        };
                    }
                    else if(params.range == "ONE_MONTH"){
                        modal_title = "LIST OF CLIENTS WITH NO PERFORMED SATURATION IN 1 MONTH ";
                        table_type = "SHOW_SATURATION_TASKS_ONE_MONTH";
                        parameters = {
                            scope: 'for-saturations',
                            range: 30,
                            task_id: params.scope
                        };
                    }
                    else if(params.range == "THREE_MONTHS"){
                        modal_title = "LIST OF CLIENTS WITH NO PERFORMED SATURATION IN 3 MONTHS ";
                        table_type = "SHOW_SATURATION_TASKS_THREE_MONTHS";
                        parameters = {
                            scope: 'for-saturations',
                            range: 90,
                            task_id: params.scope
                        };
                    }
                    else if(params.range == "SIX_MONTHS"){
                        modal_title = "LIST OF CLIENTS WITH NO PERFORMED SATURATION IN 6 MONTHS";
                        table_type = "SHOW_SATURATION_TASKS_SIX_MONTHS";
                        parameters = {
                            scope: 'for-saturations',
                            range: 180,
                            task_id: params.scope
                        };
                    }
                    else if(params.range == "ONE_YEAR") {
                        modal_title = "LIST OF CLIENTS WITH NO PERFORMED SATURATION IN 1 YEAR";
                        table_type = "SHOW_SATURATION_TASKS_ONE_YEAR";
                        parameters = {
                            scope: 'for-saturations',
                            range: 365,
                            task_id: params.scope
                        };
                    }
                    else {
                        
                    }
                }
                if(params.scope == 5){
                    if(params.range == "RECENT"){
                        modal_title = "LIST OF RECENTLY ADDED CLIENTS WITH NO PERFORMED PRESENTATION";
                        table_type = "SHOW_PRESENTATION_TASKS_RECENT";
                        parameters = {
                            scope: 'for-presentations',
                            range: 0,
                            task_id: params.scope
                        };
                    }
                    else if(params.range == "SEVEN_DAYS"){
                        modal_title = "LIST OF CLIENTS WITH NO PERFORMED FOLLOW-UP ON PRESENTATION IN 7 DAYS";
                        table_type = "SHOW_PRESENTATION_TASKS_SEVEN_DAYS";
                        parameters = {
                            scope: 'for-presentations',
                            range: 7,
                            task_id: params.scope
                        };
                    }
                    else if(params.range == "ONE_MONTH"){
                        modal_title = "LIST OF CLIENTS WITH NO PERFORMED FOLLOW-UP ON PRESENTATION IN 1 MONTH ";
                        table_type = "SHOW_PRESENTATION_TASKS_ONE_MONTH";
                        parameters = {
                            scope: 'for-presentations',
                            range: 30,
                            task_id: params.scope
                        };
                    }
                    else if(params.range == "THREE_MONTHS"){
                        modal_title = "LIST OF CLIENTS WITH NO PERFORMED FOLLOW-UP ON PRESENTATION IN 3 MONTHS ";
                        table_type = "SHOW_PRESENTATION_TASKS_THREE_MONTHS";
                        parameters = {
                            scope: 'for-presentations',
                            range: 90,
                            task_id: params.scope
                        };
                    }
                    else if(params.range == "SIX_MONTHS"){
                        modal_title = "LIST OF CLIENTS WITH NO PERFORMED FOLLOW-UP ON PRESENTATION IN 6 MONTHS";
                        table_type = "SHOW_PRESENTATION_TASKS_SIX_MONTHS";
                        parameters = {
                            scope: 'for-presentations',
                            range: 180,
                            task_id: params.scope
                        };
                    }
                    else if(params.range == "ONE_YEAR") {
                        modal_title = "LIST OF CLIENTS WITH NO PERFORMED FOLLOW-UP ON PRESENTATION IN 1 YEAR";
                        table_type = "SHOW_PRESENTATION_TASKS_ONE_YEAR";
                        parameters = {
                            scope: 'for-presentations',
                            range: 365,
                            task_id: params.scope
                        };
                    }
                    else {

                    }
                }
                if(params.scope == 4){
                    if(params.range == "RECENT"){
                        modal_title = "LIST OF RECENTLY CLIENTS WITH NO PERFORMED NEGOTIATION";
                        table_type = "SHOW_NEGOTIATION_TASKS_RECENT";
                        parameters = {
                            scope: 'for-negotiations',
                            range: 0,
                            task_id: params.scope
                        };
                    }

                    else if(params.range == "SEVEN_DAYS"){
                        modal_title = "LIST OF CLIENTS WITH NO PERFORMED FOLLOW-UP NEGOTIATION IN 7 DAYS";
                        table_type = "SHOW_NEGOTIATION_TASKS_SEVEN_DAYS";
                        parameters = {
                            scope: 'for-negotiations',
                            range: 7,
                            task_id: params.scope
                        };
                    }
                    else if(params.range == "ONE_MONTH"){
                        modal_title = "LIST OF CLIENTS WITH NO PERFORMED FOLLOW-UP NEGOTIATION IN 1 MONTH ";
                        table_type = "SHOW_NEGOTIATION_TASKS_ONE_MONTH";
                        parameters = {
                            scope: 'for-negotiations',
                            range: 30,
                            task_id: params.scope
                        };
                    }
                    else if(params.range == "THREE_MONTHS"){
                        modal_title = "LIST OF CLIENTS WITH NO PERFORMED FOLLOW-UP ON NEGOTIATION IN 3 MONTHS ";
                        table_type = "SHOW_NEGOTIATION_TASKS_THREE_MONTHS";
                        parameters = {
                            scope: 'for-negotiations',
                            range: 90,
                            task_id: params.scope
                        };
                    }
                    else if(params.range == "SIX_MONTHS"){
                        modal_title = "LIST OF CLIENTS WITH NO PERFORMED FOLLOW-UP ON NEGOTIATION IN 6 MONTHS";
                        table_type = "SHOW_NEGOTIATION_TASKS_SIX_MONTHS";
                        parameters = {
                            scope: 'for-negotiations',
                            range: 180,
                            task_id: params.scope
                        };
                    }
                    else if(params.range == "ONE_YEAR") {
                        modal_title = "LIST OF CLIENTS WITH NO PERFORMED FOLLOW-UP ON NEGOTIATION IN 1 YEAR";
                        table_type = "SHOW_NEGOTIATION_TASKS_ONE_YEAR";
                        parameters = {
                            scope: 'for-negotiations',
                            range: 365,
                            task_id: params.scope
                        };
                    }
                    else {
                        
                    }
                }
                
                this.$store.dispatch('setModalTitle', modal_title);
                this.$store.dispatch('setModalFormType', table_type);
                this.$store.dispatch('setModalParams', parameters);
                $("#table-modal").modal("show");
            } 
        },
        created() {
            this.loadPendingTasks();

             Echo.private("client-channel").listen("ClientSubrecordEvent", e => {
               this.loadPendingTasks();
            });
        },
        destroyed() {
            Echo.leave("client-channel");
        }
    }
</script>

<style>
</style>