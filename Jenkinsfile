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
        stage("Dockerized Laravel"){
            steps{
                sh 'docker build -t xovinovian/lapp .'
                sh 'docker tag xovinovian/lapp localhost:5000/xovinovian/lapp'
                sh 'docker push localhost:5000/xovinovian/lapp'
            }
        }
        stage("User Acceptance Test Laravel"){
            steps{
                sh 'docker run --rm --name mylapp_uat -p 8000:8000 -d localhost:5000/xovinovian/lapp'
                sh 'php artisan dusk'
            }
            post{
                always{
                    echo "====++++always++++===="
                    sh 'docker stop mylapp_uat'
                }
                success{
                    echo "====++++only when successful++++===="
                }
                failure{
                    echo "====++++only when failed++++===="
                }
            }
        }        
        stage("Deploy Laravel Application"){
            steps{
                sh 'docker rm -f mylapp_ops'
                sh 'docker run --name mylapp_ops -p 8001:8000 -d localhost:5000/xovinovian/lapp'
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