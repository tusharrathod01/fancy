<form action="{{ route('user.permissions.update') }}" method="POST" id="edituserpermission">
    @csrf
    <input type="hidden" name="user_id" value="{{ $permission->user_id }}">
    <div class="col-md-12 row mb-2">
        <table class="table prmision">
            <tr>
                <td>
                    <div style="display: inline-flex;padding-top: 5px;">
                        <input type="checkbox" id="add" name="add"
                            {{ $permission->add == 1 ? 'checked' : '' }}>
                        <span class="pl-2">ADD</span>
                    </div>
                </td>
                <td>
                    <div style="display: inline-flex;padding-top: 5px;">
                        <input type="checkbox" id="edit" name="edit"
                            {{ $permission->edit == 1 ? 'checked' : '' }}>
                        <span class="pl-2">EDIT</span>
                    </div>
                </td>
                <td>
                    <div style="display: inline-flex;padding-top: 5px;">
                        <input type="checkbox" id="delete" name="delete"
                            {{ $permission->delete == 1 ? 'checked' : '' }}>
                        <span class="pl-2">DELETE</span>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div style="display: inline-flex;padding-top: 5px;">
                        <input type="checkbox" id="masters_side" name="masters_side" style="width: auto"
                            {{ $permission->masters_side == 1 ? 'checked' : '' }}>
                        <span class="pl-2">MASTER</span>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</form>
