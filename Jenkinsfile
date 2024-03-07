pipeline{
    agent any
    stages{
        stage("Prepare Laravel"){
            steps{
                sh 'composer update'
                sh 'php artisan key:generate'
                sh 'composer require laravel/dusk --dev'
                sh 'php artisan dusk:install'
                sh 'php artisan dusk:chrome-driver'
            }
        }
        stage("Unit Test Laravel"){
            steps{
                sh 'php artisan test'
            }
        }
        stage("User Acceptance Test Laravel"){
            steps{
                sh 'php artisan dusk'
            }
        }
        stage("Dockerized Laravel"){
            steps{
                sh 'docker build -t xovinovian/lapp'
                sh 'docker tag xhartono/app localhost:5000/xovinovian/lapp'
                sh 'docker push localhost:5000/xovinovian/lapp'
            }
        }
        stage("Deploy Laravel Application"){
            steps{
                sh 'docker run --name mylapp -p 8005:8080 -d localhost:5000/xovinovian/lapp'
            }
        }
    }
    post{
        always{
            echo "========always========"
        }
        success{
            echo "========pipeline executed successfully ========"
        }
        failure{
            echo "========pipeline execution failed========"
        }
    }
}