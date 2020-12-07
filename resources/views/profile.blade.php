@extends('layouts.mainlayout')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type='text/javascript'>
        $(function() {
            var requiredCheckboxes = $('.preferredGenders :checkbox[required]');
            requiredCheckboxes.change(function() {
                if (requiredCheckboxes.is(':checked')) {
                    requiredCheckboxes.removeAttr('required');
                } else {
                    requiredCheckboxes.attr('required', 'required');
                }
            });
        });

    </script>
    <div class="user-info-container" id="exampleModalLong" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="false">
        <div class="modal-dialog user-info" role="document">
            <div class="modal-content user-info">
                <div class='modal-header'>
                    <h4>{{ $name }}</h4>
                </div>
                <div class="modal-body" style="width:100%;">
                    @if (request()->get('changed'))
                        <div class='alert alert-success'>Profile successfully updated.</div>
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
                    <br />
                    <form method="post" id='edit_userinfo' name="edit_userinfo" action="{{ url('/app/profile/update') }}">
                        {{ csrf_field() }}
                        <div class="mt-4">
                            <x-jet-label for="preferredGender" value="{{ __('Preferred gender(s)') }}" />
                            <div class="col-md-6 preferredGenders">
                                <input type="checkbox" name="preferredGender_male" value="m" required /> Male
                                <input type="checkbox" name="preferredGender_female" value="f" required /> Female
                                <input type="checkbox" name="preferredGender_other" value="o" required /> Other
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
