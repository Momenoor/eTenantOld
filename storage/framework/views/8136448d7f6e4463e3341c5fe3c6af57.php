<livewire-publish-modal id="livewire-publish-modal">

    
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create <?php echo e(ucfirst($selectedFileType)); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form wire:submit.prevent="formSubmit" onsubmit="publishModalLoading()">
                <div class="modal-body">
                    
                    <div>
                        <span class="d-inline-block rounded-circle text-center text-primary border-primary" style="border: 2px solid; width: 28px;">A</span>
                        <h5 class="mb-0 ml-1 d-inline-block">
                            <button type="button" wire:click="changeMode('create')" class="btn btn-link p-0 m-0">
                                Create a new <?php echo e($selectedFileType); ?>.
                            </button>
                        </h5>

                        <?php if($mode === 'create'): ?>
                        <div class="border-left pl-3 my-2 p-0 py-2" style="margin: 0 0.8rem;">
                            <label>Pick a name for the new <?php echo e($selectedFileType); ?>:</label>
                            <input autofocus id="inputName" name="inputName" required wire:model="inputName" class="form-control" id="file-to-create" placeholder="test<?php echo e(ucfirst($selectedFileType)); ?>" />
                        </div>
                        <?php endif; ?>
                    </div>

                    
                    <div class="position-relative py-3 text-center">
                        <hr class="m-0">
                        <label class="position-absolute py-1 px-2 bg-white" style="top: 0">or</label>
                    </div>

                    
                    <div <?php if(!count($visibleOptions)): ?> style="opacity: 0.5;" title="No <?php echo e(Str::of($selectedFileType)->plural()); ?> available" <?php endif; ?>>
                        <span class="d-inline-block rounded-circle text-center text-primary border-primary" style="border: 2px solid; width: 28px;">B</span>
                        <h5 class="mb-0 ml-1 d-inline-block">
                            <button type="button" wire:click="changeMode('publish')" class="btn btn-link p-0 m-0" <?php if(!count($visibleOptions)): ?> style="pointer-events: none;" <?php endif; ?>>
                                Publish an existing <?php echo e($selectedFileType); ?>.
                            </button>
                        </h5>

                        <?php if($mode === 'publish'): ?>
                        <div class="border-left pl-3 my-2 p-0 py-2" style="margin: 0 0.8rem;">
                            <label>Select an existing <?php echo e($selectedFileType); ?> to publish:</label>
                            <select autofocus id="selectedFile" name="selectedFile" wire:model="selectedFile" class="form-control" id="file-to-publish">
                                
                                <?php $__currentLoopData = $visibleOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project => $options): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <optgroup label="<?php echo e($project); ?>" class="text-uppercase">
                                    <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>" wire:key="file_option_<?php echo e($loop->index); ?>" style="text-transform: initial;"><?php echo e($option); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </optgroup>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <div class="text-muted font-sm mt-4">
                                <p>
                                    This will copy-paste the blade file from the Backpack package to your <code><?php echo e($selectedFileTypePath); ?></code>,
                                    where you can customize it to fit your needs. Backpack will automatically use the published file if present.
                                </p>
                                <p>
                                    Take into consideration that by publishing (aka overriding) a blade file, you will no longer get the updates for that blade
                                    file when you do <code>composer update</code>. For an easy-to-upgrade admin panel, it's recommended that you override blade
                                    files as little as possible. In most cases, it would be better to <i>rename</i> the file after it's been published,
                                    and only use it inside the Controllers/Views where strictly needed.
                                </p>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="d-flex align-items-center btn btn-primary" action="<?php echo e($mode); ?>"><i class="la la-circle-o-notch la-spin d-none"></i><?php echo e(ucfirst($mode)); ?></button>
                </div>
            </form>
        </div>
    </div>

    <script type="module">
        let $modal = $('#livewire-publish-modal');
        let modalButton = $modal.find('[type="submit"]').get(0);

        // when a menu item that triggers this modal is clicked, set
        // the value of selectedFileType to what the menu intended 
        // so that the dropdown gets populated with the blade
        // files for that type of file
        $("#devToolsNavBar a.dropdown-item[data-target='#livewire-publish-modal']").click(function() {
            window.livewire.find('<?php echo e($_instance->id); ?>').initModal(this.dataset.fileType);
        });

        // focus first input on modal show
        $modal.on('shown.bs.modal', () => $modal.find('input').focus());

        // reset modal on close
        $modal.on('hidden.bs.modal', () => window.livewire.find('<?php echo e($_instance->id); ?>').set('mode', 'create'));

        // focus input on mode change
        window.addEventListener('publish-modal-mode', () => $modal.find('input, select').focus());

        // listen for
        window.addEventListener('publish-modal', (event) => {
            new Noty({
                type: event.detail.success ? 'success' : 'error',
                text: `<strong>${event.detail.title}</strong><br>${event.detail.message}`,
            }).show();

            if (event.detail.success) {
                $modal.modal('hide');
            }

            publishModalLoading(false);
        });

        // toggle modal loadiong state
        window.publishModalLoading = (loading = true) => {
            modalButton.firstChild.classList.toggle('d-none', !loading);
            loading ? modalButton.setAttribute('disabled', true) : modalButton.removeAttribute('disabled');
        }
    </script>
</livewire-publish-modal>
<?php /**PATH C:\wamp64\www\eTenant\vendor\backpack\devtools\src/../resources/views/livewire/modals/publish-modal.blade.php ENDPATH**/ ?>