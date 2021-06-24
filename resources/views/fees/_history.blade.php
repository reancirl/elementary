<div class="modal fade" id="history_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-primary" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Transaction History</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <table class="table table-responsive-sm table-striped text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Paid Amount</th>
                            <th>Date</th>
                            <th>Catered by</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $i => $t)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ number_format($t->paid_amount,2) ?? '' }}</td>
                                <td>{{ date('M d,Y',strtotime($t->created_at )) ?? '' }}</td>
                                <td>{{ $t->user->name ?? '' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>