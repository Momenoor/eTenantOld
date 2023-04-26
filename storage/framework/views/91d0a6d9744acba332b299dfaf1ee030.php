<livewire-create-page-modal id="livewire-create-page-modal">

    
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Page</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form wire:submit.prevent="formSubmit" onsubmit="createPageModalLoading()">
                <div class="modal-body">
                    <div style="display: grid; grid-template-columns: 1fr 3rem; grid-template-rows: repeat(2, 1fr);">
                        <div class="p-0 py-2">
                            <label>View name:</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text">resources/views/</span>
                                </div>
                                <input autofocus name="name" required wire:model="name" class="form-control <?php if(isset($this->errors['view'])): ?> is-invalid <?php endif; ?>" placeholder="page_name" pattern=".+\w$" title="Please provide a valid path/name." />
                                <div class="input-group-append">
                                    <span class="input-group-text">.blade.php</span>
                                </div>
                                <div class="invalid-feedback">
                                    <?php echo e($this->errors['view'] ?? ''); ?>

                                </div>
                            </div>
                        </div>
                        <div class="p-0 py-2">
                            <label>Route:</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text"><?php echo e(url($this->prefix)); ?>/</span>
                                </div>
                                <input name="route" wire:model="route" class="form-control <?php if(isset($this->errors['route'])): ?> is-invalid <?php endif; ?>" />
                                <div class="invalid-feedback">
                                    <?php echo e($this->errors['route'] ?? ''); ?>

                                </div>
                            </div>
                        </div>
                        <div class="text-<?php echo e($this->routeEdited ? 'black-50' : 'primary'); ?>" style="grid-row: 1 / 3; grid-column: 2;">
                            <span class="d-block position-abolsute" style="border-left: 2px solid; height: 55%; transform: translate(1.8rem, 3.5rem)">
                                <span class="position-absolute rounded-circle text-center bg-white" style="top: 50%; border: 2px solid; width: 1.75rem; z-index: 1; transform: translate(-50%, -50%); <?php echo e($this->routeEdited ? 'cursor: pointer;' : ''); ?>" wire:click="resetRoute">
                                    <i class="las la-lock<?php echo e($this->routeEdited ? '-open' : ''); ?>"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>

                <?php if($this->preview): ?>
                <div class="preview">
                    <div class="jumbotron mx-3 px-4 py-3 shadow">
                        <?php $__currentLoopData = ['view', 'url', 'controller']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label class="mb-0 text-black-50 text-uppercase font-weight-bold font-sm"><?php echo e(ucfirst($value)); ?></label>
                        <p class="font-sm text-monospace text-primary" style="overflow-wrap: break-word;"><?php echo e($this->preview[$value] ?? ''); ?></p>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <?php endif; ?>

                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="d-flex align-items-center btn btn-primary" <?php if(!$this->preview || count($this->errors)): echo 'disabled'; endif; ?>><i class="la la-circle-o-notch la-spin d-none"></i>Create</button>
                </div>
            </form>
        </div>
    </div>

    <script type="module">
        let $modal = $('#livewire-create-page-modal');
        let modalButton = $modal.find('[type="submit"]').get(0);

        // when a menu item that triggers this modal is clicked, set
        // the value of selectedFileType to what the menu intended 
        // so that the dropdown gets populated with the blade
        // files for that type of file
        $("#devToolsNavBar a.dropdown-item[data-target='#livewire-create-page-modal']").click(function() {
            window.livewire.find('<?php echo e($_instance->id); ?>').initModal(this.dataset.fileType);
        });

        // focus first input on modal show
        $modal.on('shown.bs.modal', () => $modal.find('input').first().focus());

        // listen for
        window.addEventListener('create-page-modal', (event) => {
            new Noty({
                type: event.detail.success ? 'success' : 'error',
                text: `<strong>${event.detail.title}</strong><br>${event.detail.message}`,
            }).show();

            if (event.detail.success) {
                $modal.modal('hide');
            }

            createPageModalLoading(false);
        });

        // toggle modal loading state
        window.createPageModalLoading = (loading = true) => {
            modalButton.firstChild.classList.toggle('d-none', !loading);
            loading ? modalButton.setAttribute('disabled', true) : modalButton.removeAttribute('disabled');
        };
    </script>
</livewire-create-page-modal>
<?php /**PATH C:\wamp64\www\eTenant\vendor\backpack\devtools\src/../resources/views/livewire/modals/create-page-modal.blade.php ENDPATH**/ ?>