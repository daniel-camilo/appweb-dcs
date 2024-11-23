// Pipeline usando SSH Agent Plugin.
pipeline {
    agent any

    environment {
        APP_NAME = "appweb-ssh-cloud"
        HOSTSERVER = "jenkins@10.118.0.2"
    }

    stages {

        stage("Build Image") {
            steps {
                sshagent(['ssh-docker']) {
                    sh """
                    ssh ${env.HOSTSERVER} 'docker build -t harbor.dcwork.com.br/appweb-pipeline/appweb-jks:${env.BUILD_ID} -f ${env.WORKSPACE}/Dockerfile ${env.WORKSPACE}/src'
                    """
                }
            }
        }

        stage("Push Docker Image") {
            steps {
                sshagent(['ssh-docker']) {
                    withCredentials([usernamePassword(credentialsId: 'harbor_credential', usernameVariable: 'HARBOR_USER', passwordVariable: 'HARBOR_PASS')]) {
                        sh """
                        ssh ${env.HOSTSERVER} "
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
                sshagent(['ssh-docker']) {
                    sh """
                    ssh ${env.HOSTSERVER} "
                        docker pull harbor.dcwork.com.br/appweb-pipeline/appweb-jks:${env.BUILD_ID} &&
                        docker stop ${env.APP_NAME} || true &&
                        docker rm ${env.APP_NAME} || true &&
                        docker run -d --name ${env.APP_NAME} -p 9094:80 harbor.dcwork.com.br/appweb-pipeline/appweb-jks:${env.BUILD_ID}
                    "
                    """
                }
            }
        }
    }
}
