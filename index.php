<?php include "templates/header.html"; ?>
  <!-- Aquí el código HTML de la aplicación -->
  <div class="page-content container note-has-grid">
    <ul class="nav nav-pills p-3 bg-white mb-3 rounded-pill align-items-center">
        <li class="nav-item">
            <a class="nav-link rounded-pill note-link d-flex align-items-center px-2 px-md-3 mr-0 mr-md-2 active">
                <span class="d-none d-md-block">Notes App</span>
            </a>
        </li>
        <li class="nav-item ml-auto">
            <button class="nav-link btn-primary rounded-pill d-flex align-items-center px-3" id="add-notes">Add Note</button>
        </li>
    </ul>
    <div class="tab-content bg-transparent">
        <div id="note-full-container" class="note-has-grid row">
            <div class="col-md-4 single-note-item all-category" style="">
                <div class="card card-body">
                    <span class="side-stick"></span>
                    <h5 class="note-title text-truncate w-75 mb-0" data-noteheading="Book a Ticket for Movie">Book a Ticket for Movie <i class="point fa fa-circle ml-1 font-10"></i></h5>
                    <p class="note-date font-12 text-muted">11 March 2009</p>
                    <div class="note-content">
                        <p class="note-inner-content text-muted" data-notecontent="Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.">Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.</p>
                    </div>
                </div>
            </div>
            <!-- Primer renderizado de las notas -->
            <?php

            $enlace = mysqli_connect("localhost", "root", "", "note");

            if (!$enlace) {
                echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
                echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
                exit;
            }

            // Obtener las notas de la tabla 'notes'
            $sql = "SELECT * FROM notes";

            if (!$resultado = $enlace->query($sql)) {
                echo "Lo sentimos, este sitio web está experimentando problemas.";
                exit;
            }

            // Borramos las notas renderizadas
            echo "<script>document.getElementById('note-full-container').innerHTML = '';</script>";

            // Renderizamos las notas
            while ($nota = $resultado->fetch_assoc()) {
                echo "<div class='col-md-4 single-note-item all-category note-important'>";
                echo "<div class='card card-body'>";
                echo "<span class='side-stick'></span>";
                echo "<h5 class='note-title text-truncate w-75 mb-0' data-noteheading='Book a Ticket for Movie'>" . $nota['title'] . "<i class='point fa fa-circle ml-1 font-10'></i></h5>";
                echo "<p class='note-date font-12 text-muted'>" . $nota['created_at'] . "</p>";
                echo "<div class='note-content'>";
                echo "<p class='note-inner-content text-muted' data-notecontent='Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.'>" . $nota['description'] . "</p>";
                echo "<div class='d-flex flex-row'>";
                echo "<form action='index.php' method='delete'>";
                echo "<input type='hidden' name='id' value='" . $nota['id'] . "'>";
                echo "<input class='nav-link btn-danger rounded-pill d-flex align-items-center px-2 mr-2' type='submit' name='delete' value='Delete Note'>";
                echo "</form>";
                echo "<form action='index.php' method='put'>";
                echo "<input type='hidden' name='id' value='" . $nota['id'] . "'>";
                echo "<input class='nav-link btn-info rounded-pill d-flex align-items-center px-2 mr-2' type='submit' name='update' value='Update Note'>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }

            $resultado->free();
            mysqli_close($enlace);
            ?>
        </div>
    </div>

    <!-- Modal Add notes -->
    <div class="modal " id="addnotesmodal" role="dialog" aria-labelledby="addnotesmodalTitle" style="display: none; z-index: 20">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title text-white">Add Notes</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" id="close-modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="index.php" method="post">
                    <div class="modal-body">
                        <div class="notes-box">
                            <div class="notes-content">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="note-title">
                                            <label>Note Title</label>
                                            <input type="text" id="note-has-title" class="form-control" placeholder="Title" name="title"/>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="note-description">
                                            <label>Note Description</label>
                                            <textarea id="note-has-description" class="form-control" placeholder="Description" rows="3" name="description"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="add" class="btn btn-primary add-notes" value="Add Note">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Update notes -->
    <?php
    $enlace = mysqli_connect("localhost", "root", "", "note");
    
    if (!$enlace) {
        echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
        echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
        exit;
    }

    // Obtener la nota a actualizar
    if (isset($_GET['update'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM notes WHERE id = $id";

        if (!$resultado = $enlace->query($sql)) {
            echo "Lo sentimos, este sitio web está experimentando problemas.";
            exit;
        }

        $nota = $resultado->fetch_assoc();
        // Renderizamos el modal con la nota a actualizar
        echo "<div class='modal ' id='updatenotesmodal' role='dialog' aria-labelledby='updatenotesmodalTitle' style='display: block; z-index: 20'>";
        echo "<div class='modal-dialog modal-dialog-centered' role='document'>";
        echo "<div class='modal-content border-0'>";
        echo "<div class='modal-header bg-info text-white'>";
        echo "<h5 class='modal-title text-white'>Update Notes</h5>";
        echo "<button type='button' class='close text-white' data-dismiss='modal' aria-label='Close' id='close-modal-2'>";
        echo "<span aria-hidden='true'>×</span>";
        echo "</button>";
        echo "</div>";
        echo "<form action='index.php' method='post'>";
        echo "<div class='modal-body'>";
        echo "<div class='notes-box'>";
        echo "<div class='notes-content'>";
        echo "<div class='row'>";
        echo "<div class='col-md-12 mb-3'>";
        echo "<div class='note-title'>";
        echo "<label>Note Title</label>";
        echo "<input type='text' id='note-has-title' class='form-control' placeholder='Title' name='title-actualizar' value='" . $nota['title'] . "'/>";
        echo "</div>";
        echo "</div>";
        echo "<div class='col-md-12'>";
        echo "<div class='note-description'>";
        echo "<label>Note Description</label>";
        echo "<textarea id='note-has-description' class='form-control' placeholder='Description' rows='3' name='description-actualizar'>" . $nota['description'] . "</textarea>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "<div class='modal-footer'>";
        echo "<input type='hidden' name='id-actualizar' value='" . $nota['id'] . "'>";
        echo "<input type='submit' name='update-note' class='btn btn-primary add-notes' value='Update Note'>";
        echo "</div>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
        echo "</div>";

        $resultado->free();
        mysqli_close($enlace);
    }
    ?>

</div>

<!-- Borrar una Nota -->
<?php
$enlace = mysqli_connect("localhost", "root", "", "note");

if (!$enlace) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    exit;
}

if (isset($_GET['delete'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM notes WHERE id = $id";

    if (!$resultado = $enlace->query($sql)) {
        echo "Lo sentimos, este sitio web está experimentando problemas.";
        exit;
    }

    echo "<script>window.location.href = 'index.php';</script>";
}

mysqli_close($enlace);
?>

<!-- Crear nota -->
<?php
$enlace = mysqli_connect("localhost", "root", "", "note");

if (!$enlace) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    exit;
}

if (isset($_POST['title']) && isset($_POST['description'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $sql = "INSERT INTO notes (title, description) VALUES ('$title', '$description')";

    if (!$resultado = $enlace->query($sql)) {
        echo "Lo sentimos, este sitio web está experimentando problemas.";
        exit;
    }

    echo "<script>window.location.href = 'index.php';</script>";

}

mysqli_close($enlace);
?>

<!-- Actualizar nota -->
<?php
$enlace = mysqli_connect("localhost", "root", "", "note");

if (!$enlace) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    exit;
}

if (isset($_POST['title-actualizar']) && isset($_POST['description-actualizar'])) {
    $title = $_POST['title-actualizar'];
    $description = $_POST['description-actualizar'];
    $id = $_POST['id-actualizar'];
    $sql = "UPDATE notes SET title = '$title', description = '$description' WHERE id = $id";

    if (!$resultado = $enlace->query($sql)) {
        echo "Lo sentimos, este sitio web está experimentando problemas.";
        exit;
    }

    echo "<script>window.location.href = 'index.php';</script>";

}

mysqli_close($enlace);
?>

<?php include "templates/footer.html"; ?>