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
<?php include 'form.php'; ?>
    <h1>Release Dashboard</h1>
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
                            <?php echo strlen($registro['changeLog']) > 50 ? substr($registro['changeLog'], 0, 50) . '...' : $registro['changeLog']; ?>
                        </td>
                        <td>
                            <form method="POST" action="" style="display:inline;">
                                <input type="hidden" name="proyecto" value="<?php echo $registro['proyecto']; ?>">
                                <input type="hidden" name="entorno" value="<?php echo $registro['entorno']; ?>">
                                <input type="hidden" name="version" value="<?php echo $registro['version']; ?>">
                                <input type="hidden" name="delete" value="1">
                                <button type="submit" class="btn-delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<button id="icon" class="add-icon icon-container">+</button>

<script src="../public/js/scripts.js"></script>
</body>
</html>