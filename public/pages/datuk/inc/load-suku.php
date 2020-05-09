<?php
    session_start();
    if(is_null($_SESSION['username'])){
        echo '<script>window.location="../../../assets/403"</script>';
    }
    include ('../../../inc/koneksi.php');
?>
    <h4 style="text-align: center;">Tribe List</h4>
   
        <table width="100%" class="table table-striped table-bordered table-hover" id="listsuku">
            <thead>
                <tr style="text-align: center">
                    <th>No.</th>
                    <th>Name of Tribe</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql=pg_query("SELECT * FROM tribe ORDER BY name_of_tribe ASC");
                    $no=1;
                    while ($data=pg_fetch_assoc($sql)) {
                        $id=$data['tribe_id'];
                        $id_enc= "'".base64_encode($id)."'";
                        $suku=$data['name_of_tribe'];
                        $ids="'".$id."'";
                        echo "<tr>";
                        echo "<td>".$no."</td>";
                        echo "<td>".$suku."</td>";
                        echo '<td>
                            <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#edit-suku'.$id.'"><i class="fa fa-edit"></i> Edit</button>
                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete-suku'.$id.'"><i class="fa fa-trash"></i> Delete</button>
                            </td>';
                        echo "</tr>";

                        $j_datuk=pg_num_rows(pg_query("SELECT datuk_id FROM datuk WHERE tribe_id='$id'"));

                        echo '
                            <div class="modal fade" id="delete-suku'.$id.'">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete '.$suku.' ?</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <div class="modal-body"><center>
                                            <p>Are you sure to delete "'.$suku.'" from tribe list ? <br/>
                                            </center>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-danger" onclick="hapussuku('.$id_enc.','.$ids.')">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="edit-suku'.$id.'">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <form method="post" id="form-editjenis">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Name of Tribe:</p>
                                                <input type="text" class="form-control" id="suku-edit'.$id.'" placeholder="Enter tribal name..." value="'.$suku.'">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-primary" onclick="editsuku('.$ids.')""><i class="ti-save"></i> Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        ';
                        $no++;
                    }
                ?>
            </tbody>
        </table>

<script type="text/javascript">
	$(document).ready(function() {
        $('#listsuku').DataTable();
    } );
</script>