<div class="modal fade" id="primaryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-primary" role="document">
        <div class="modal-content">
            <form action="{{ route('transactions.store') }}" method="post">
                @csrf              
                <div class="modal-header">
                    <h5 class="modal-title">Transact payment for <span id="student_name"></span></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="fee_id" id="fee_id">
                    <label for="remaining_balance">Remaining Balance:</label>
                    <input type="number" name="remaining_balance" class="form-control mb-3" readonly id="remaining_balance">

                    <label for="paid_amount">Amount:</label>
                    <input type="number" name="paid_amount" class="form-control mb-3" id="paid_amount" step="any" required>

                    <label for="paid_amount">Change:</label>
                    <input type="number" class="form-control mb-3" id="change_amount" value="0.00" readonly>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Submit Payment</button>
                </div>
            </form>
        </div>
    </div>
</div>