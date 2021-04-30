<div class="modal fade" id="bomtree-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-80">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bill of Materials | &nbsp;</h5>
                <button type="button" class="btn btn-primary btn-flat btn-xs" id="bomtree-btn-fullscreen"><i class="ti-fullscreen"></i> &nbsp; View in Fullscreen</button>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <table>
                    <tr>
                        <td style="width: 50px; background-color: #007ad0; border-top: none !important;"></td>
                        <td style="padding-left: 10px; padding-right: 20px; border-top: none !important;">FP - Finish Products</td>
                        <td style="width: 50px; background-color: #911010; border-top: none !important;"></td>
                        <td style="padding-left: 10px; padding-right: 20px; border-top: none !important;">RM - Raw Material and SP - Standard & Special Part</td>
                        <td style="width: 50px; background-color: #009985; border-top: none !important;"></td>
                        <td style="padding-left: 10px; padding-right: 20px; border-top: none !important;">WP - Work in Process and Others</td>
                        
                    </tr>
                </table>

                <hr />

                <div id="bomtree-chart" width="100%"></div>
              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
