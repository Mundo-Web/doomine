@extends('components.public.matrix')

@section('css_importados')

@stop


@section('content')

  <main>
    <section class="my-12">
      <div class="bg-[#F5F5F5] font-poppins">
        <div class="relative bg-[#F5F5F5] px-6 pt-10 pb-8 mt-8 ring-gray-900/5 sm:mx-auto sm:rounded-lg sm:px-10">
          <div class="mx-auto px-5">
            <div class="flex flex-col items-center">
              <h2 class="font-semibold text-[40px] text-[#151515] text-center leading-none md:leading-tight">
                Preguntas Frecuentes
              </h2>
            </div>
            <div class="mx-auto mt-8 grid max-w-[900px] divide-y divide-neutral-200">

              @if ($faqs->count() > 0)
                @foreach ($faqs as $faq)
                  <div class="py-5">
                    <details class="group">
                      <summary class="flex cursor-pointer list-none items-center justify-between font-medium">
                        <span class="font-bold text-[20px] text-[#151515]">
                          {!! $faq->pregunta !!}</span>
                        <span class="transition group-open:rotate-180">
                          <svg width="18" height="20" viewBox="0 0 18 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M16.2923 11.3882L9.00065 18.3327M9.00065 18.3327L1.70898 11.3882M9.00065 18.3327L9.00065 1.66602"
                              stroke="#EB5D2C" stroke-width="3.33333" stroke-linecap="round" stroke-linejoin="round" />
                          </svg>
                        </span>
                      </summary>
                      <p class="group-open:animate-fadeIn mt-3 text-neutral-600">
                        {!! $faq->respuesta !!}
                      </p>
                    </details>
                  </div>
                @endforeach
              @endif




            </div>
          </div>
        </div>
      </div>
      </div>
    </section>

  </main>


@section('scripts_importados')


@stop

@stop
