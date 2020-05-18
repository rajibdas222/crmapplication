<!-- Add new user Modal -->
<div class="modal fade" id="new_user_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('messages.add_user')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" style="padding: 0px !important;">
                <div id="user_message"></div>
                <form method="POST" id="user_create">
                    <div class="row">
                        <div class="col-md-6">

                            @csrf

                            <div class="form-group">
                                <label for="name" class="col-md-12 col-form-label">{{__('messages.name')}}</label>

                                <div class="col-md-12">
                                    <input id="name" type="text" class="form-control" name="name" required autofocus
                                        placeholder="{{__('messages.name')}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-md-12 col-form-label">{{__('messages.email')}}</label>
                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control" name="email"
                                        placeholder="{{__('messages.email')}}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password"
                                    class="col-md-12 col-form-label">{{__('messages.password')}}</label>
                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control" name="password"
                                        placeholder="{{__('messages.password')}}" autocomplete="Password" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm"
                                    class="col-md-12 col-form-label">{{__('messages.user_list_confirm_password')}}</label>
                                <div class="col-md-12">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation"
                                        placeholder="{{__('messages.user_list_confirm_password')}}"
                                        autocomplete="Confirm Password" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 ml-auto">
                            <div class="form-group">
                                <label for="role_for_user" class="col-md-12 col-form-label">Select role</label>
                                <div class="col-md-12">
                                    <select name="role_for_user" id="role_for_user" class="form-control" multiple>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="permission_for_user" class="col-md-12 col-form-label">Select permission</label>
                                <div class="col-md-12" id="permission_for_user"></div>
                            </div>
                        </div>

                    </div>
                </form>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('messages.close')}}</button>
                <button type="submit" class="btn btn-primary" id="new_user_save">{{__('messages.add')}}</button>
            </div>

        </div>
    </div>
</div>
<!-- Add new user Modal End -->