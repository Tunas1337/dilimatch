<?php $__env->startSection('content'); ?>
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
                    <h4><?php echo e($name); ?></h4>
                </div>
                <div class="modal-body" style="width:100%;">
                    <?php if(request()->get('changed')): ?>
                        <div class='alert alert-success'>Profile successfully updated.</div>
                    <?php endif; ?>
                    <?php if(request()->get('fail')): ?>
                        <div class='alert alert-danger'>Something went wrong while updating; please try again.</div>
                    <?php endif; ?>
                    <strong>Bio:</strong>
                    <textarea class="form-control" form='edit_userinfo' name='bio' id="user-bio"
                        rows="3"><?php echo e($bio); ?></textarea>
                    <strong>Interests:</strong>
                    <textarea class="form-control" form='edit_userinfo' name='interests' id="user-interests"
                        rows="3"><?php echo e($interests); ?></textarea>
                    <strong>Preference:</strong>
                    <textarea class="form-control" form='edit_userinfo' name='preference' id="user-preference"
                        rows="3"><?php echo e($preference); ?></textarea>
                    <form method="post" id='edit_userinfo' name="edit_userinfo" action="<?php echo e(url('/app/profile/update')); ?>">
                        <?php echo e(csrf_field()); ?>

                        <div class="mt-4">
                             <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['for' => 'gender','value' => ''.e(__('Preferred gender(s) (or, which gender you are)')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['for' => 'gender','value' => ''.e(__('Preferred gender(s) (or, which gender you are)')).'']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
                            <div class="alert alert-danger" id='nogender-own' style='display:none;'><i>Please choose your gender.</i></div>
                            <div class="col-md-6 preferredGenders">
                                <input type="radio" name="gender" value="m" <?php if($gender == 'm'): ?> checked <?php endif; ?> required/> Male
                                <input type="radio" name="gender" value="f" <?php if($gender == 'f'): ?> checked <?php endif; ?>/>
                                Female
                                <input type="radio" name="gender" value="o" <?php if($gender == 'o'): ?> checked <?php endif; ?>/>
                                Other
                            </div>
                        </div>
                        <div class="mt-4">
                             <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['for' => 'preferredGender','value' => ''.e(__('Preferred gender(s) (or, which gender(s) you would like to be shown)')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['for' => 'preferredGender','value' => ''.e(__('Preferred gender(s) (or, which gender(s) you would like to be shown)')).'']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
                            <div class="alert alert-danger" id='nogender' style='display:none;'><i>Please choose at least one preferred gender.</i></div>
                            <div class="col-md-6 preferredGenders">
                                <input type="checkbox" name="preferredGender_male" value="m" <?php if(in_array('m', $preferredGenders)): ?> checked <?php endif; ?>/> Male
                                <input type="checkbox" name="preferredGender_female" value="f" <?php if(in_array('f', $preferredGenders)): ?> checked <?php endif; ?>/>
                                Female
                                <input type="checkbox" name="preferredGender_other" value="o" <?php if(in_array('o', $preferredGenders)): ?> checked <?php endif; ?>/>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/profile.blade.php ENDPATH**/ ?>