<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Halaman Profil</b></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>"><i class="fa-solid fa-house"></i></a></li>
                    <li class="breadcrumb-item"><span>Profile</span></li>
                </ol>
            </div>
        </div>
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                <?= session()->getFlashdata('success'); ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('errors')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5><i class="icon fas fa-exclamation-triangle"></i> Kesalahan!</h5>
                <?= implode('<br>', session()->getFlashdata('errors')) ?>
            </div>
        <?php endif; ?>

    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">My Profile</a></li>
                            <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">History</a></li>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">UnDone</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- Tab-pane for Activity -->
                            <div class="tab-pane active" id="activity">
                                <div class="card-body d-flex flex-column">
                                    <div class="row flex-grow-1">
                                        <div class="col-12">
                                            <div class="card bg-light d-flex flex-fill">
                                                <div class="card-header text-muted border-bottom-0">
                                                    <h4> <?= $user['department_name'] ?? '-' ?></h4>
                                                </div>

                                                <div class="card-body d-flex flex-column pt-3">
                                                    <div class="row flex-grow-1">
                                                        <div class="col-7">
                                                            <h2 class="lead mt-8"><b><?= session()->get('employee_name') ?? '-' ?> / <?= session()->get('employee_id') ?? '-' ?></b></h2>

                                                            <p class="text-muted text-sm"><b>Posisi: </b> <?= esc($user['employee_position'] ?? '-'); ?></p>
                                                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                                                <li class="small"><span class="fa-li"><i class="fa-regular fa-id-badge"></i></span>Badge: <?= esc($user['employee_badge'] ?? '-'); ?></li>
                                                                <li class="small"><span class="fa-li"><i class="fa-solid fa-location-dot"></i></span> Alamat: <?= esc($user['employee_address'] ?? '-'); ?></li>
                                                                <li class="small"><span class="fa-li"><i class="fa-regular fa-envelope"></i></span> Email: <?= esc($user['employee_email'] ?? '-'); ?></li>
                                                                <li class="small"><span class="fa-li"><i class="fa-solid fa-square-phone"></i></span> No. Telepon: <?= esc($user['employee_phone'] ?? '-'); ?></li>
                                                            </ul>
                                                            <br>
                                                            <p class="text-muted text-sm">
                                                                <b>Bergabung Sejak: </b> <?= esc($user['created_at'] ?? '-'); ?> | <?= esc($sinceCreate ?? '-'); ?>
                                                            </p>
                                                            <p class="text-muted text-sm">
                                                                <b>Terakhir Diperbarui: </b> <?= esc($user['updated_at'] ?? '-'); ?> | <?= esc($sinceUpdate ?? '-'); ?>
                                                            </p>

                                                            <br>
                                                        </div>
                                                        <div class="col-5 text-center">
                                                            <img src="<?= base_url('uploads/profile/' . esc($user['employee_image'])); ?>" alt="user-avatar" class="img-circle img-fluid" width="170">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="text-left">
                                                        <?php
                                                        $id_department = session()->get('id_department');
                                                        $employee_position = session()->get('employee_position');
                                                        $employee_badge = session()->get('employee_badge');
                                                        $employee_address = session()->get('employee_address');
                                                        $employee_phone = session()->get('employee_phone');
                                                        if (empty($id_department) || empty($employee_position) || empty($employee_badge) || empty($employee_address) || empty($employee_phone)) {
                                                            echo '<a href="<a href="' . base_url('admin/profile/edit') . '" class="btn btn-sm btn-warning"><i class="fa-solid fa-list-check"></i> Lengkapi Data</a>';
                                                        } else {
                                                            echo '<a href="' . base_url('admin/profile/edit') . '" class="btn btn-sm btn-primary"><i class="fa-regular fa-pen-to-square"></i> Perbarui Data</a>';
                                                        }
                                                        ?>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane for Activity -->
                            <!-- Tab-pane for Timeline -->
                            <div class="tab-pane" id="timeline">
                                <!-- The timeline -->
                                <div class="timeline timeline-inverse">
                                    <!-- timeline time label -->
                                    <div class="time-label">
                                        <span class="bg-danger">
                                            10 Feb. 2014
                                        </span>
                                    </div>
                                    <!-- /.timeline-label -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-envelope bg-primary"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> 12:05</span>

                                            <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                                            <div class="timeline-body">
                                                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                                weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                                jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                                quora plaxo ideeli hulu weebly balihoo...
                                            </div>
                                            <div class="timeline-footer">
                                                <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                                <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-user bg-info"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                                            <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                                            </h3>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-comments bg-warning"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                                            <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                                            <div class="timeline-body">
                                                Take me to your leader!
                                                Switzerland is small and neutral!
                                                We are more like Germany, ambitious and misunderstood!
                                            </div>
                                            <div class="timeline-footer">
                                                <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <!-- timeline time label -->
                                    <div class="time-label">
                                        <span class="bg-success">
                                            3 Jan. 2014
                                        </span>
                                    </div>
                                    <!-- /.timeline-label -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-camera bg-purple"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                                            <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                                            <div class="timeline-body">
                                                <img src="https://placehold.it/150x100" alt="...">
                                                <img src="https://placehold.it/150x100" alt="...">
                                                <img src="https://placehold.it/150x100" alt="...">
                                                <img src="https://placehold.it/150x100" alt="...">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <div>
                                        <i class="far fa-clock bg-gray"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane for Timeline -->

                            <!-- Tab-pane for Settings -->
                            <div class="tab-pane" id="settings">
                                <form class="form-horizontal">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputName" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputName2" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-danger">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane for Settings -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>