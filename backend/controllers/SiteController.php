<?php

namespace backend\controllers;

use common\models\LoginForm;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use common\models\SalesTargets;
use common\models\SalesAchieved;
use common\models\Product;
use common\models\Users;
use yii\helpers\Json;
use yii\db\Query;



/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ], 
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
         $dbMonthyear = SalesTargets::getMonthYearDropdowns();
         $dbSalesrepresentatives = SalesTargets::getSalesRepresentativesDropdowns();
    
        // $params = [];
         $selectedMonthYear = Yii::$app->request->get('monthyear');
        // $salesrepresentatives = Yii::$app->request->get('salesrepresentatives');
        // if ($monthyear) {
        //     $params[] = ['=', 'month_year', $monthyear];
        // }
        // if ($salesrepresentatives) {
        //   
        //      $params[] = ['=', 'sales_representative_column_name', $salesrepresentatives];
        // }
        //  $salesChartData = SalesTargets::getChartData($params);
        //  $salesData = SalesAchieved::getSalesData($monthyear);
    
        $salesChartData = $this->getSalesChartData($selectedMonthYear);
       // $productChartData = $this->actionGetProductData($selectedMonthYear);

        return $this->render('index', [
            'monthyearData' => $dbMonthyear,
            'salesrepresentativesData' => $dbSalesrepresentatives,
            'salesChartLabels' => $salesChartData['labels'],
            'salesTargetsData' => $salesChartData['salesTargets'],
            'salesAchievedData' => $salesChartData['salesAchieved'],
        //    'productChartLabels' => $productChartData['productNames'],
        //    'productChartQuantities' => $productChartData['salesQuantities'],
    
            //  'salesChartLabels' => $salesChartData->label,
            //  'salesChartData' => $salesChartData->data,
        ]);
    }
    
    
    private function getSalesChartData($monthYear)
    {
        // Your logic to fetch and process the chart data here
        $labels = []; // Sales representative names
        $salesTargets = []; // Sales target amounts
        $salesAchieved = []; // Sales achieved amounts
    
        // Retrieve sales target data for the selected month and year
        $salesTargetData = SalesTargets::find()
            ->select(['users.name AS rep_name', 'SUM(sales_targets.sales_target_amount) as sales_target'])
            ->joinWith(['rep.user']) // Assuming you have a relation named 'rep' linking to 'SalesRepresentatives' and 'user' linking to 'Users'
            ->where(['sales_targets.month_year' => $monthYear])
            ->groupBy(['users.name'])
            ->asArray()
            ->all();
        //    var_dump($salesTargetData);
            
    
        // Process $salesTargetData to populate $labels and $salesTargets arrays
    
        // Retrieve sales achieved data for the selected month and year
        $salesAchievedData = SalesAchieved::find()
            ->select(['users.name AS rep_name', 'SUM(sales_achieved_amount) as sales_achieved'])
            ->joinWith(['rep.user']) // Assuming similar relations as in the sales target data
            ->where(['sales_achieved.month_year' => $monthYear])
            ->groupBy(['users.name'])
            ->asArray()
            ->all();
       //     var_dump($salesAchievedData);
         //   exit();
    
        // Process $salesAchievedData to populate $salesAchieved array
    
        return [
            'labels' => $labels,
            'salesTargets' => $salesTargets,
            'salesAchieved' => $salesAchieved,
        ];
    }
    
    // public function actionGetProductData($monthYear)
    // {
    //     // Implement the logic to fetch product data for the selected monthYear
    //     $productNames = []; // Product names for the pie chart
    //     $salesQuantities = []; // Sales quantities for each product
    
    //     // Query the database to retrieve product data based on the selected monthYear
    //     $productData = (new Query())
    //         ->select(['p.product_name', 'SUM(sd.quantity_sold) as total_quantity_sold'])
    //         ->from(['p' => 'product'])
    //         ->innerJoin(['sd' => 'sales_details'], 'p.product_id = sd.product_id')
    //         ->innerJoin(['sa' => 'sales_achieved'], 'p.product_id = sa.product_id')
    //         ->where(['sa.month_year' => $monthYear])
    //         ->groupBy(['p.product_name'])
    //         ->all();
    
    //     foreach ($productData as $data) {
    //         $productNames[] = $data['product_name'];
    //         $salesQuantities[] = $data['total_quantity_sold'];
    //     }
    
    //     // Prepare the response data
    //     $response = [
    //         'productNames' => $productNames,
    //         'salesQuantities' => $salesQuantities,
    //     ];
    
    //     // Return the response as JSON
    //     Yii::$app->response->format = Response::FORMAT_JSON;
    //     return $response;
    // }    
           


    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
    
        $this->layout = 'blank';
    
        $model = new Users(); 
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = Users::findByUsername($model->username);
            if ($user && $user->validatePassword($model->password_hash)) {
                Yii::$app->user->login($user);
                return $this->goBack();
            }
            else {
                
              //  $model->addError('username', 'Incorrect username or password.');
                $model->addError('password_hash', 'Incorrect username or password.');
            }
        }
    
        $model->password_hash = ''; 
    
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    
    
    

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
