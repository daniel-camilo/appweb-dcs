// Pipeline usando SSH Agent Plugin.
pipeline {
    agent any

    environment {
        VAR_PATH = "/tmp/build-${env.BUILD_ID}"
        APP_NAME = "appweb-ssh-cloud"
    }

    stages {
        stage("Clone Repository") {
            steps {
                sshagent(['jenkins-docker']) {
                    sh """
                    ssh jenkins@10.108.0.2 'git clone https://github.com/daniel-camilo/appweb-dcs.git ${VAR_PATH}'
                    """
                }
            }
        }

        stage("Build Image") {
            steps {
                sshagent(['jenkins-docker']) {
                    sh """
                    ssh jenkins@10.108.0.2 'docker build -t harbor.dcwork.com.br/appweb-pipeline/appweb-jks:${env.BUILD_ID} -f ${VAR_PATH}/Dockerfile ${VAR_PATH}/src'
                    """
                }
            }
        }

        stage("Push Docker Image") {
            steps {
                sshagent(['jenkins-docker']) {
                    withCredentials([usernamePassword(credentialsId: 'harbor_credential', usernameVariable: 'HARBOR_USER', passwordVariable: 'HARBOR_PASS')]) {
                        sh """
                        ssh jenkins@10.108.0.2 "
                            docker login harbor.dcwork.com.br --username $HARBOR_USER --password $HARBOR_PASS &&
                            docker push harbor.dcwork.com.br/appweb-pipeline/appweb-jks:${env.BUILD_ID}
                        "
                        """
                    }
                }
            }
        }

        stage("Deploy Application") {
            steps {
                sshagent(['jenkins-ssh-docker']) {
                    sh """
                    ssh jenkins@10.108.0.2 "
                        docker pull harbor.dcwork.com.br/appweb-pipeline/appweb-jks:${env.BUILD_ID} &&
                        docker stop ${APP_NAME} || true &&
                        docker rm ${APP_NAME} || true &&
                        docker run -d --name ${APP_NAME} -p 9094:80 harbor.dcwork.com.br/appweb-pipeline/appweb-jks:${env.BUILD_ID}
                    "
                    """
                }
            }
        }
    }
}
