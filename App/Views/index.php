<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Release Dashboard</title>
    <link rel="stylesheet" href="../public/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<div class="container">
    <h1>Release Dashboard</h1>
    <?php include 'form.php'; ?>
    <?php include 'edit_form.php'; ?>
    <!-- Top section with 4 boxes -->
    <div class="card-grid">
        <?php if ($proIdcat) { ?>
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-box"></i>
                        IDCAT
                    </h2>
                    <span class="badge badge-red">
                        <i class="fas fa-server"></i>
                        PRODUCTION
                    </span>
                </div>
                <div class="card-content">
                    <?php $versiones = explode(" ", $proIdcat['version']); ?>
                    <div class="version">API: <?php echo $versiones[0]; ?> || op: <?php echo $versiones[1]; ?> || ci: <?php echo $versiones[2]; ?></div>
                    <p class="date">
                        <i class="fas fa-calendar-alt"></i>
                        <?php echo $proIdcat['fecha'] ?>
                    </p>
                </div>
            </div>
        <?php } ?>

        <?php if ($proOsiris) { ?>
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-box"></i>
                        OSIRIS
                    </h2>
                    <span class="badge badge-red">
                        <i class="fas fa-server"></i>
                        PRODUCTION
                    </span>
                </div>
                <div class="card-content">
                    <div class="version"><?php echo $proOsiris['version'];?></div>
                    <p class="date">
                        <i class="fas fa-calendar-alt"></i>
                        <?php echo $proOsiris['fecha'] ?>
                    </p>
                </div>
            </div>
        <?php } ?>

        <?php if ($preOsiris) { ?>
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-box"></i>
                        OSIRIS
                    </h2>
                    <span class="badge badge-blue">
                        <i class="fas fa-server"></i>
                        PRE
                    </span>
                </div>
                <div class="card-content">
                    <div class="version"><?php echo $preOsiris['version'];?></div>
                    <p class="date">
                        <i class="fas fa-calendar-alt"></i>
                        <?php echo $preOsiris['fecha'] ?>
                    </p>
                </div>
            </div>
        <?php } ?>    

        <?php if ($preIdcat) { ?>
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-box"></i>
                        IDCAT
                    </h2>
                    <span class="badge badge-blue">
                        <i class="fas fa-server"></i>
                        PRE
                    </span>
                </div>
                <div class="card-content">
                    <?php $versiones = explode(" ", $preIdcat['version']); ?>
                    <div class="version">API: <?php echo $versiones[0]; ?> || op: <?php echo $versiones[1]; ?> || ci: <?php echo $versiones[2]; ?></div>
                    <p class="date">
                        <i class="fas fa-calendar-alt"></i>
                        <?php echo $preIdcat['fecha'] ?>
                    </p>
                </div>
            </div>
        <?php } ?>
    </div>

    <!-- Bottom section with table -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Release History</h2>
        </div>
        <div class="card-content">
            <table>
                <thead>
                    <tr>
                        <th>Environment</th>
                        <th>Project</th>
                        <th>Version</th>
                        <th>Release Date</th>
                        <th>Changelog</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($registros as $registro) { ?>
                    <tr>
                        <td>
                            <span class="badge badge-<?php echo strtolower($registro['entorno']) === 'pro' ? 'red' : 'blue'; ?>">
                                <i class="fas fa-<?php echo strtolower($registro['entorno']) === 'pro' ? 'server' : 'code-branch'; ?>"></i>
                                <?php echo ucfirst(strtolower($registro['entorno'])); ?>
                            </span>
                        </td>
                        <td>
                            <i class="fas fa-<?php echo strtolower($registro['proyecto']) === 'osiris' ? 'rocket' : 'box'; ?>"></i>
                            <?php echo ucfirst(strtolower($registro['proyecto'])); ?>
                        </td>
                        <td><?php echo $registro['version']; ?></td>
                        <td>
                            <i class="fas fa-calendar-alt"></i>
                            <?php echo $registro['fecha']; ?>
                        </td>
                        <td>
                            <i class="fas fa-file-alt"></i>
                            <span class="short-changelog"><?php echo strlen($registro['changeLog']) > 70 ? substr($registro['changeLog'], 0, 70) . '...' : $registro['changeLog']; ?></span>
                            <span class="full-changelog" style="display:none;"><?php echo $registro['changeLog']; ?></span>
                            <button type="button" class="btn-toggle-changelog">
                                <i class="fas fa-chevron-down"></i>
                            </button>
                        </td>
                        <td>
                            <form method="POST" action="" class="delete-form" style="display:inline;">
                                <input type="hidden" name="proyecto" value="<?php echo $registro['proyecto']; ?>">
                                <input type="hidden" name="entorno" value="<?php echo $registro['entorno']; ?>">
                                <input type="hidden" name="version" value="<?php echo $registro['version']; ?>">
                                <input type="hidden" name="delete" value="1">
                                <button type="submit" class="btn-delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                            <button type="button" class="btn-edit btn-delete" data-id="<?php echo $registro['id']; ?>">
                                <i class="fas fa-edit"></i>
                            </button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="edit-popup" class="popup-overlay">
    <div class="popup-content">
        <div class="cabecera-popup">Editar Registro</div>
        <form id="edit-form" method="POST" action="">
            <input type="hidden" name="id" id="edit-id">
            <label for="edit-proyecto">Proyecto:</label>
            <input type="text" name="proyecto" id="edit-proyecto" required>
            <label for="edit-entorno">Entorno:</label>
            <select name="entorno" id="edit-entorno" required>
                <option value="PRO">PRO</option>
                <option value="PRE">PRE</option>
            </select>
            <label for="edit-version">Versión:</label>
            <input type="text" name="version" id="edit-version" required>
            <label for="edit-fecha">Fecha:</label>
            <input type="date" name="fecha" id="edit-fecha" required>
            <label for="edit-changelog">Changelog:</label>
            <textarea name="changeLog" id="edit-changelog" required></textarea>
            <button type="submit" class="boton-guardar">Guardar Cambios</button>
        </form>
    </div>
</div>

<button id="icon" class="add-icon icon-container">+</button>

<script src="../public/js/scripts.js"></script>
</body>
</html>