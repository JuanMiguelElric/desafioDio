<li @class(['ui-state-default', $completed])>

    <span class="handle ui-sortable-handle">
        <i class="fas fa-ellipsis-v"></i>
        <i class="fas fa-ellipsis-v"></i>
    </span>
    {{-- {{ dd("completed: $completed", "id: $id", "badge: $badge", "title: $title", "time: $time") }} --}}
    
    <div class="icheck-primary d-inline ml-2">
        <input type="checkbox" class="checkIn" value="{{$id}}" name="task" id="task_{{ $id }}" @checked(($completed))>
        <label for='task_{{ $id }}'></label>
    </div>

    <span class="text">{{ $title }}</span>

    <x-todo.clock badge="{{ $badge }}">{{ $time }}</x-todo.clock>

    <div class="tools">
        <i class="fas fa-edit todo-edit" data-dado-id="{{ $id }}" data-toggle="modal" data-target="#modalEditaTask"></i>
        <i class="fas fa-trash todo-trash" data-dado-id="{{ $id }}"></i>
    </div>
</li>
