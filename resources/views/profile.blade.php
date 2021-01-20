@extends('layouts.mainlayout')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type='text/javascript'>
        $(function() {
            var requiredCheckboxes = $('.preferredGenders :checkbox');
            requiredCheckboxes.change(function() {
                var checkedCheckboxes = $('.preferredGenders :checkbox[checked]');
                if (requiredCheckboxes.is(':checked')) {
                    requiredCheckboxes.removeAttr('required');
                    $('#submit-btn')[0].disabled = false;
                    $('#nogender').css('display', 'none');
                } else {
                    var checkedCheckboxes = $('.preferredGenders :checkbox[checked]');
                    requiredCheckboxes.attr('required', 'required');
                    $('#nogender').css('display', 'block');
                    $('#submit-btn')[0].disabled = true;
                }
            });
        });
    </script>
    <div class="user-info-container" id="userinfo" tabindex="1" role="dialog" aria-labelledby="userInfo"
        aria-hidden="false">
        <div class="modal-dialog user-info" role="document">
            <div class="modal-content user-info">
                <div class='modal-header'>
                    <h4>{{ $name }}</h4>
                </div>
                <div class="modal-body" style="width:100%;">
                    @if (request()->get('changed'))
                        <div class='alert alert-success'>Profile successfully updated.</div>
                    @endif
                    @if (request()->get('fail'))
                        <div class='alert alert-danger'>Something went wrong while updating; please try again.</div>
                    @endif
                    <strong>Bio:</strong>
                    <textarea class="form-control" form='edit_userinfo' name='bio' id="user-bio"
                        rows="3">{{ $bio }}</textarea>
                    <strong>Interests:</strong>
                    <textarea class="form-control" form='edit_userinfo' name='interests' id="user-interests"
                        rows="3">{{ $interests }}</textarea>
                    <strong>Preference:</strong>
                    <textarea class="form-control" form='edit_userinfo' name='preference' id="user-preference"
                        rows="3">{{ $preference }}</textarea>
                    <form method="post" id='edit_userinfo' name="edit_userinfo" action="{{ url('/app/profile/update') }}">
                        {{ csrf_field() }}
                        <div class="mt-4">
                            <x-jet-label for="preferredGender" value="{{ __('Preferred gender(s) (or, which gender(s) you would like to be shown)') }}" />
                            <div class="alert alert-danger" id='nogender' style='display:none;'><i>Please choose at least one preferred gender.</i></div>
                            <div class="col-md-6 preferredGenders">
                                <input type="checkbox" name="preferredGender_male" value="m" @if (in_array('m', $preferredGenders)) checked @endif/> Male
                                <input type="checkbox" name="preferredGender_female" value="f" @if (in_array('f', $preferredGenders)) checked @endif/>
                                Female
                                <input type="checkbox" name="preferredGender_other" value="o" @if (in_array('o', $preferredGenders)) checked @endif/>
                                Other
                            </div>
                        </div>
                        <br />
                        <button type="submit" id='submit-btn' class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
