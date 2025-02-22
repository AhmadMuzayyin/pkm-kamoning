<section class="d-flex flex-column gap-4">
    <header>
        <h2 class="h4 fw-medium text-dark">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-2 text-secondary small">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button class="btn btn-danger" data-bs-toggle="modal"
        data-bs-target="#deleteUserAccount">{{ __('Delete Account') }}</button>

    <x-modal id="deleteUserAccount" name="confirm-user-deletion" title="{{ __('Delete Account') }}">
        <form method="post" action="{{ route('profile.destroy') }}" class="p-4">
            @csrf
            @method('delete')

            <h2 class="h4 fw-medium text-dark">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-2 text-secondary small">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-4">
                <label for="password" class="visually-hidden">{{ __('Password') }}</label>

                <input id="password" name="password" type="password" class="form-control w-75"
                    placeholder="{{ __('Password') }}" />

                @error('password', 'userDeletion')
                    <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-4 d-flex justify-content-end">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    {{ __('Cancel') }}
                </button>

                <button type="submit" class="btn btn-danger ms-2">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
