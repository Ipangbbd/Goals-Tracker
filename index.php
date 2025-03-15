<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Goals Checklist By Ali</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            margin-top: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card {
            margin-bottom: 20px;
            border: none;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #ff9800;
            color: white;
            font-weight: bold;
        }

        .btn-orange {
            background-color: #ff9800;
            color: white;
        }

        .btn-orange:hover {
            background-color: #e68a00;
            color: white;
        }

        .list-group-item {
            position: relative;
        }

        .completed {
            text-decoration: line-through;
            color: #6c757d;
        }

        .delete-btn {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #dc3545;
            cursor: pointer;
        }

        .check-btn {
            margin-right: 10px;
            cursor: pointer;
            color: #28a745;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center mb-4">Goals Checklist</h1>

        <ul class="nav nav-tabs mb-4" id="goalTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="daily-tab" data-bs-toggle="tab" data-bs-target="#daily" type="button" role="tab">Daily Goals</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="monthly-tab" data-bs-toggle="tab" data-bs-target="#monthly" type="button" role="tab">Monthly Goals</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="yearly-tab" data-bs-toggle="tab" data-bs-target="#yearly" type="button" role="tab">Yearly Goals</button>
            </li>
        </ul>

        <!-- Tab content -->
        <div class="tab-content" id="goalTabsContent">
            <!-- Daily Goals Tab -->
            <div class="tab-pane fade show active" id="daily" role="tabpanel">
                <div class="card">
                    <div class="card-header">Add Daily Goal</div>
                    <div class="card-body">
                        <form action="process.php" method="post">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="goal_text" placeholder="Enter your daily goal" required>
                                <input type="hidden" name="goal_type" value="daily">
                                <button class="btn btn-orange" type="submit" name="add_goal">Add Goal</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">Daily Goals List</div>
                    <ul class="list-group list-group-flush">
                        <?php
                        require_once 'db_connect.php';
                        $sql = "SELECT * FROM goals WHERE goal_type='daily' ORDER BY completed ASC, id DESC";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $completedClass = $row['completed'] ? 'completed' : '';
                                echo '<li class="list-group-item ' . $completedClass . '">';
                                echo '<form action="process.php" method="post" class="d-inline">';
                                echo '<input type="hidden" name="goal_id" value="' . $row['id'] . '">';
                                if ($row['completed']) {
                                    echo '<button type="submit" name="uncheck_goal" class="btn btn-sm check-btn"><i class="fas fa-check-circle"></i></button>';
                                } else {
                                    echo '<button type="submit" name="check_goal" class="btn btn-sm check-btn"><i class="far fa-circle"></i></button>';
                                }
                                echo $row['goal_text'];
                                echo '<button type="submit" name="delete_goal" class="btn btn-sm delete-btn"><i class="fas fa-trash"></i></button>';
                                echo '</form>';
                                echo '</li>';
                            }
                        } else {
                            echo '<li class="list-group-item">No daily goals yet.</li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>

            <!-- Monthly Goals Tab -->
            <div class="tab-pane fade" id="monthly" role="tabpanel">
                <div class="card">
                    <div class="card-header">Add Monthly Goal</div>
                    <div class="card-body">
                        <form action="process.php" method="post">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="goal_text" placeholder="Enter your monthly goal" required>
                                <input type="hidden" name="goal_type" value="monthly">
                                <button class="btn btn-orange" type="submit" name="add_goal">Add Goal</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">Monthly Goals List</div>
                    <ul class="list-group list-group-flush">
                        <?php
                        $sql = "SELECT * FROM goals WHERE goal_type='monthly' ORDER BY completed ASC, id DESC";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $completedClass = $row['completed'] ? 'completed' : '';
                                echo '<li class="list-group-item ' . $completedClass . '">';
                                echo '<form action="process.php" method="post" class="d-inline">';
                                echo '<input type="hidden" name="goal_id" value="' . $row['id'] . '">';
                                if ($row['completed']) {
                                    echo '<button type="submit" name="uncheck_goal" class="btn btn-sm check-btn"><i class="fas fa-check-circle"></i></button>';
                                } else {
                                    echo '<button type="submit" name="check_goal" class="btn btn-sm check-btn"><i class="far fa-circle"></i></button>';
                                }
                                echo $row['goal_text'];
                                echo '<button type="submit" name="delete_goal" class="btn btn-sm delete-btn"><i class="fas fa-trash"></i></button>';
                                echo '</form>';
                                echo '</li>';
                            }
                        } else {
                            echo '<li class="list-group-item">No monthly goals yet.</li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>

            <!-- Yearly Goals Tab -->
            <div class="tab-pane fade" id="yearly" role="tabpanel">
                <div class="card">
                    <div class="card-header">Add Yearly Goal</div>
                    <div class="card-body">
                        <form action="process.php" method="post">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="goal_text" placeholder="Enter your yearly goal" required>
                                <input type="hidden" name="goal_type" value="yearly">
                                <button class="btn btn-orange" type="submit" name="add_goal">Add Goal</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">Yearly Goals List</div>
                    <ul class="list-group list-group-flush">
                        <?php
                        $sql = "SELECT * FROM goals WHERE goal_type='yearly' ORDER BY completed ASC, id DESC";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $completedClass = $row['completed'] ? 'completed' : '';
                                echo '<li class="list-group-item ' . $completedClass . '">';
                                echo '<form action="process.php" method="post" class="d-inline">';
                                echo '<input type="hidden" name="goal_id" value="' . $row['id'] . '">';
                                if ($row['completed']) {
                                    echo '<button type="submit" name="uncheck_goal" class="btn btn-sm check-btn"><i class="fas fa-check-circle"></i></button>';
                                } else {
                                    echo '<button type="submit" name="check_goal" class="btn btn-sm check-btn"><i class="far fa-circle"></i></button>';
                                }
                                echo $row['goal_text'];
                                echo '<button type="submit" name="delete_goal" class="btn btn-sm delete-btn"><i class="fas fa-trash"></i></button>';
                                echo '</form>';
                                echo '</li>';
                            }
                        } else {
                            echo '<li class="list-group-item">No yearly goals yet.</li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>

</html>