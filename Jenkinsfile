pipeline {
    agent any

    stages {
        stage("Clone Repository") {
            steps {
                sshagent(['jenkins-docker']) {
                    sh """
                    ssh jenkins@10.108.0.2 'git clone https://github.com/seu-usuario/seu-repo.git /tmp/build'
                    """
                }
            }
        }

        stage("Build Image") {
            steps {
                sshagent(['jenkins-docker']) {
                    sh """
                    ssh jenkins@10.108.0.2 'docker build -t harbor.dcwork.com.br/appweb-pipeline/appweb-jks:${env.BUILD_ID} -f /tmp/build/Dockerfile /tmp/build/src'
                    """
                }
            }
        }

        stage("Push Docker Image") {
            steps {
                sshagent(['jenkins-docker']) {
                    withCredentials([usernamePassword(credentialsId: 'harbor_credential', usernameVariable: 'HARBOR_USER', passwordVariable: 'HARBOR_PASS')]) {
                        sh """
                        ssh jenkins@10.108.0.2 '
                            docker login harbor.dcwork.com.br --username $HARBOR_USER --password $HARBOR_PASS &&
                            docker push harbor.dcwork.com.br/appweb-pipeline/appweb-jks:${env.BUILD_ID}'
                        '
                        """
                    }
                }
            }
        }
    }
}
