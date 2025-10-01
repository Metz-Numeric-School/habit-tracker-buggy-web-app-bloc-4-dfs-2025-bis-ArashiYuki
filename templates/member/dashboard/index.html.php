<?php $layout = 'base.html.php'; ?>

<div class="container py-5">
    <h1 class="mb-4">Bonjour <?= htmlspecialchars($_SESSION['user']['firstname'] ?? "", ENT_QUOTES, "UTF-8") ?> !</h1>

    <div class="row mb-4">
        <!-- Statistiques rapides -->
        <div class="col-md-4 mb-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Habitudes actives</h5>
                    <p class="card-text display-4"><?= htmlspecialchars($stats['active_habits'] ?? 0) ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Jours consécutifs</h5>
                    <p class="card-text display-4"><?= htmlspecialchars($stats['streak_days'] ?? 0) ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Habitudes complétées aujourd'hui</h5>
                    <p class="card-text display-4"><?= htmlspecialchars($stats['completed_today'] ?? 0) ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Liste des habitudes -->
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Mes habitudes</h2>
                <a href="/habits/create" class="btn btn-primary">Ajouter une habitude</a>
            </div>

            <div class="row">
                <!-- Liste des habitudes -->
                <?php if (!empty($habits)): ?>
                    <div class="row">
                        <?php foreach ($habits as $habit): ?>
                            <div class="col-md-4 mb-3">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= htmlspecialchars($habit->getName() ?? "") ?></h5>
                                        <p class="card-text"><?= htmlspecialchars($habit->getDescription() ?? "") ?></p>

                                        <form action="/habit/toggle" method="post" class="mb-2">
                                            <input type="hidden" name="habit_id" value="<?= htmlspecialchars($habit->getId() ?? "") ?>">
                                            <button type="submit"
                                                class="btn <?= $habit->isCompletedToday() ? 'btn-success' : 'btn-outline-success' ?> btn-sm">
                                                <?= $habit->isCompletedToday() ? 'Fait ✅' : 'Marquer comme fait' ?>
                                            </button>
                                        </form>

                                        <p class="mb-1 text-muted">Progression 7 derniers jours :</p>
                                        <div class="progress mb-2">
                                            <div class="progress-bar" role="progressbar"
                                                style="width: <?= htmlspecialchars($habit->getProgress(7) ?? 0) ?>%;"
                                                aria-valuenow="<?= htmlspecialchars($habit->getProgress(7) ?? 0) ?>" aria-valuemin="0" aria-valuemax="100">
                                                <?= $habit->getProgress(7) ?>%
                                            </div>
                                        </div>

                                        <small class="text-muted">
                                            <?= htmlspecialchars($habit->isCompletedToday() ?? false) ? 'Habitude faite aujourd’hui' : 'Non faite aujourd’hui' ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-muted">Vous n’avez encore aucune habitude. <a href="/habits/create">Créez-en une maintenant</a>.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>