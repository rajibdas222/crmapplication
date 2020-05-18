<!-- Password change Modal -->
<div class="modal fade" id="change_password_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('messages.change_password')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" style="padding: 0px !important;">
                <div id="change_password_message"></div>
                <form method="POST" id="change_password" class="" style="padding: 1em !important;">
                    @csrf

                    <input type="hidden" name="user_id" id="change_pass_user_id">
                    <div class="form-group row">
                        <label for="new_password"
                            class="col-md-4 col-form-label">{{__('messages.new_password')}}</label>

                        <div class="col-md-8">
                            <input id="new_password" type="password" class="form-control" name="new_password"
                                placeholder="{{__('messages.new_password')}}" autocomplete="New Password" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="new_password_confirm"
                            class="col-md-4 col-form-label">{{__('messages.confirm_password')}}</label>

                        <div class="col-md-8">
                            <input id="new_password_confirm" type="password" class="form-control"
                                name="new_password_confirm" placeholder="{{__('messages.confirm_password')}}"
                                autocomplete="Confirm Password" required>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="close_user" data-dismiss="modal">{{__('messages.close')}}</button>
                <button type="submit" class="btn btn-primary" id="change_password_save">{{__('messages.save')}}</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Password change Modal End -->