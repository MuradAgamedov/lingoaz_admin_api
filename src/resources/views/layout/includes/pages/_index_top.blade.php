   <div class="mb-3" style="display: flex; align-items: center; justify-content: space-between;">
       <h6 class="card-title mb-4">Dictionary</h6>
       <div class="inline-flex">
           <button type="button" class="relative btn rounded-e-none bg-primary/85 rounded-s text-white">
               Dropdown Split
           </button>

           <div class="hs-dropdown relative [--placement:bottom-left] inline-flex open">
               <button type="button" class="hs-dropdown-toggle relative py-2 px-3 rounded-e flex justify-center items-center bg-primary text-white">
                   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="chevron-down" class="lucide lucide-chevron-down size-4">
                       <path d="m6 9 6 6 6-6"></path>
                   </svg>
               </button>

               <div style="display:none" class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 min-w-40 py-2 px-0 bg-card shadow-md rounded-md block" role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-default" tabindex="-1" style="position: fixed; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(1209.02px, 10.5938px, 0px);" data-placement="top-start">
                   <div class="space-y-0.5">
                       <a class="py-1.5 px-4 block font-medium hover:bg-default-100 dark:hover:bg-default-200" href="{{route($create . '.create')}}">
                           Create new
                       </a>

                       <a class="py-1.5 px-4 block font-medium hover:bg-default-100 dark:hover:bg-default-200" href="#">
                           Delete selected
                       </a>
                   </div>
               </div>
           </div>
       </div>
   </div>
