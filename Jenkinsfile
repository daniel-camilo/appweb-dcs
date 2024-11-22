// Pipeline usando SSH Agent Plugin.
pipeline {
    agent any

    environment {
        VAR_PATH = "/tmp/build-${env.BUILD_ID}"
    }

    stages {
        stage("Clone Repository") {
            steps {
                sshagent(['jenkins-ssh-docker']) {
                    sh """
                    ssh jenkins@192.168.150.52 'git clone https://github.com/daniel-camilo/appweb-dcs.git ${VAR_PATH}'
                    """
                }
            }
        }

        stage("Build Image") {
            steps {
                sshagent(['jenkins-ssh-docker']) {
                    sh """
                    ssh jenkins@192.168.150.52 'docker build -t harbor.dcwork.com.br/appweb-pipeline/appweb-jks:${env.BUILD_ID} -f ${VAR_PATH}/Dockerfile ${VAR_PATH}/src'
                    """
                }
            }
        }

        stage("Push Docker Image") {
            steps {
                sshagent(['jenkins-ssh-docker']) {
                    withCredentials([usernamePassword(credentialsId: 'harbor_credential', usernameVariable: 'HARBOR_USER', passwordVariable: 'HARBOR_PASS')]) {
                        sh """
                        ssh jenkins@192.168.150.52 "
                            docker login harbor.dcwork.com.br --username $HARBOR_USER --password $HARBOR_PASS &&
                            docker push harbor.dcwork.com.br/appweb-pipeline/appweb-jks:${env.BUILD_ID}
                        "
                        """
                    }
                }
            }
        }
    }
}
