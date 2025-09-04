<div>
{{--    @if(Session::has('error'))--}}
{{--        <div class="alert alert-danger text-right" role="alert">--}}
{{--            {{ Session::get('error') }}--}}
{{--        </div>--}}
{{--    @endif--}}
{{--    @if(Session::has('success'))--}}
{{--        <div class="alert alert-success text-right" role="alert">--}}
{{--            {{ Session::get('success') }}--}}
{{--        </div>--}}
{{--    @endif--}}
{{--        @if(Session::has('lockout_time'))--}}
{{--            <div class="alert alert-success text-right" role="alert">--}}
{{--                {{ Session::get('lockout_time') }}--}}
{{--            </div>--}}
{{--
      @endif--}}


        @if (session('success'))
            <script>
                Swal.fire({
                    title: 'نجاح 🎉',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'تمام'
                });
            </script>
        @endif
</div>
@if (session('error'))
    <script>
        Swal.fire({
            title: 'خطا ',
            text: '{{ session('error') }}',
            icon: 'error',
            confirmButtonText: 'ارجع'
        });
    </script>
    @endif
    </div>
