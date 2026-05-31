   <div class="mb-3" style="display: flex; align-items: center; justify-content: space-between;">
       <h6 class="card-title mb-4">Dictionary</h6>
       <div class="inline-flex gap-2">
           <a href="{{route($create . '.create')}}" class="btn bg-primary text-white px-4 py-2 rounded-md">
               Create new
           </a>
           <button type="button" onclick="submitBulkDelete()" class="btn bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md">
               Delete selected
           </button>
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
            const checked = document.querySelectorAll('input[name="ids[]"]:checked');
            if (checked.length === 0) {
                alert('Please select at least one item to delete.');
                return;
            }
            if (confirm('Are you sure you want to delete the selected items?')) {
                form.submit();
            }
        }
    }
</script>
