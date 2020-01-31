@inject('taskType', 'ConfrariaWeb\Task\Services\TaskTypeService')
@inject('taskStatus', 'ConfrariaWeb\Task\Services\TaskStatusService')
@inject('userMeridien', 'MeridienClube\Meridien\Services\UserService')

<div class="portlet">
    <div class="portlet__head">
        <div class="portlet__head-label">
            <h3 class="portlet__head-title">
                Informações adicionais para schedule
            </h3>
        </div>
    </div>
    <div class="portlet__body">
        <div class="form-group">
            <label class="control-label">Que Tipo de tarefa</label>
            {{ Form::select('options[task][type_id]', $taskType->pluck(), $schedule->options['task']['type_id']?? NULL, ['id' => 'option_task_type_id', 'class' => 'form-control'], ['server_side' => ['route' => 'api.tasks.types.select2']]) }}
        </div>

        <div class="form-row">
            <div class="col">
                <label class="control-label">Data da tarefa</label>
                {!! Form::text('options[task][datetime]', $schedule->options['task']['datetime']?? null, ['class' => 'form-control']) !!}
                <small>
                    Pode utilizar este formato data (+ 12 dias) ou (+ 6 meses)
                </small>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label">Destinatário da tarefa</label>
            {{ Form::select2('options[task][sync][destinateds][]', isset($schedule->options['task']['sync']['destinateds'])? $userMeridien->where($schedule->options['task']['sync']['destinateds'])->pluck() : [], $schedule->options['task']['sync']['destinateds']?? [], ['id' => 'option_task_user_destinateds', 'class' => 'form-control'], ['server_side' => ['route' => 'api.users.select2']]) }}
            <small class="form-text text-muted">
                Este perfil pode criar pessoas com os perfis listados acima, estes perfis
                ficaram disponiveis para o usuário quando o mesmo for criar uma nova pessoa.
            </small>
        </div>
        <div class="form-group">
            <label class="control-label">Responsavel para esta tarefa</label>
            {{ Form::select2('options[task][sync][responsibles][]', isset($schedule->options['task']['sync']['responsibles'])? $userMeridien->where($schedule->options['task']['sync']['responsibles'])->pluck() : [], $schedule->options['task']['sync']['responsibles']?? [], ['id' => 'option_task_user_responsibles', 'class' => 'form-control'], ['server_side' => ['route' => 'api.users.select2']]) }}
        </div>
        <div class="form-group">
            <label class="control-label">Quem abriu a tarefa</label>
            {{ Form::select2('options[task][user_id]', isset($schedule->options['task']['user_id'])? $userMeridien->where(['id' => $schedule->options['task']['user_id']])->pluck() : [], $schedule->options['task']['user_id']?? NULL, ['id' => 'option_task_user_id', 'class' => 'form-control'], ['server_side' => ['route' => 'api.users.select2']]) }}
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label class="control-label">Status</label>
                {{ Form::select('options[task][status_id]', $taskStatus->pluck(), $schedule->options['task']['status_id']?? NULL, ['id' => 'option_task_status_id', 'class' => 'form-control'], ['server_side' => ['route' => 'api.tasks.statuses.select2']]) }}
            </div>
            <div class="form-group col-md-6">
                <label class="control-label">Prioridade</label>
                {{ Form::select('options[task][priority]', [1 => 'Muito baixa',2 => 'Baixa',3 => 'Normal', 4 => 'Alta', 5 => 'Muito alta'], $schedule->options['task']['priority']?? NULL, ['class' => 'form-control kt-select2']) }}
            </div>
        </div>
        <div class="form-group">
            <label class="control-label">Descrição da tarefa<span class=""> </span></label>
            {!! Form::textarea('options[task][sync][optionsValues][description]', $schedule->options['task']['sync']['optionsValues']['description']?? NULL, ['class' => 'form-control', 'placeholder' => 'Digite a descrição desta tarefa']) !!}
        </div>
    </div>
</div>
