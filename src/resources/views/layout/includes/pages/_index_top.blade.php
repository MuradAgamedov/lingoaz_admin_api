   <div class="mb-3" style="display: flex; align-items: center; justify-content: space-between;">
       <h6 class="card-title mb-4">Dictionary</h6>
       <div class="inline-flex">
           <a href="{{route($create . '.create')}}" class="relative btn rounded-s bg-primary/85 text-white px-4">
               Create new
           </a>

           <div class="hs-dropdown relative [--placement:bottom-left] inline-flex">
               <button type="button" id="hs-dropdown-split" class="hs-dropdown-toggle relative py-2 px-3 rounded-e flex justify-center items-center bg-primary text-white">
                   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4">
                       <path d="m6 9 6 6 6-6"></path>
                   </svg>
               </button>

               <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 min-w-40 py-2 px-0 bg-card shadow-md rounded-md hidden" role="menu" tabindex="-1">
                   <div class="space-y-0.5">
                       <a class="py-1.5 px-4 block font-medium hover:bg-default-100 dark:hover:bg-default-200 text-red-600 cursor-pointer" onclick="event.preventDefault(); submitBulkDelete();">
                           Delete selected
                       </a>
                   </div>
               </div>
           </div>
       </div>
   </div>

<script>
    if (typeof submitBulkDelete === 'undefined') {
        function submitBulkDelete() {
            const form = document.getElementById('bulk-delete-form');
            if (!form) {
                alert('No bulk action form found on this page.');
                return;
            }
            
            const checked = form.querySelectorAll('input[name="ids[]"]:checked');
            if (checked.length === 0) {
                alert('Please select at least one item to delete.');
                return;
            }
            
            if (confirm('Are you sure you want to delete the selected items?')) {
                const formData = new FormData(form);
                const url = form.getAttribute('action');
                
                fetch(url, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                })
                .then(response => {
                    if (response.redirected) {
                        window.location.href = response.url;
                    } else if (response.ok) {
                        window.location.reload();
                    } else {
                        response.text().then(text => {
                            console.error('Server Error:', text);
                            // If there is dd() output, alert or display it
                            if (text.includes('sf-dump') || text.length < 500) {
                                document.body.innerHTML = text;
                            } else {
                                alert('Error: ' + response.status + ' ' + response.statusText);
                            }
                        });
                    }
                })
                .catch(error => {
                    console.error('Network Error:', error);
                    alert('Network error. Check browser console.');
                });
            }
        }
    }
</script>
