pipeline{
    agent any
    stages{
        stage("Prepare Laravel"){
            steps{
                sh 'php artisan key:generate'
            }
        }
        stage("Laravel Test"){
            steps{
                sh 'php artisan test'
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
                sh 'docker run --name mylapp -p 8000:8000 -d localhost:5000/xovinovian/lapp'
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