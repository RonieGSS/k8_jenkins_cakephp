// Cakephp Staging Environment

// Pipeline Variables
def app = "cakephp3"

// Pipeline Functions

/** 
 * Blue/Green Deployment Functions
 */

/**
 * Reads the site deploy from staging deploy.txt file
 *
 * @param deploymentDir the directory path towards deploy.txt file
 * @return deploy -> either "blue" or "green" - the service to deploy
 */
def getCurrentDeployment(deploymentDir) {
	def deployCode = readFile("./ops/docker/$deploymentDir/deploy.txt").trim()
	return deployCode
}
/**
 * Get the switch code based from deploy
 *
 * @param deploymentDir the directory path towards deploy.txt file
 * @return deploy code -> either empty string('') or '-green' - the service to switch to
 */
def getSwitchCode(deploymentDir) {
	def currentDeployment = getCurrentDeployment(deploymentDir)
	def codes = ['green':'', 'blue':'-green']

	if (currentDeployment == 'blue' || currentDeployment == 'green') {
		return codes.get(currentDeployment)
	}
	return 'Error'
}
/**
 * Get the deployment code based from deploy
 *
 * @param deploymentDir the directory path towards deploy.txt file
 * @return deploy -> either "blue" or "green" - the service to deploy
 */
def getDeploymentCode(deploymentDir) {
	def currentDeployment = getCurrentDeployment(deploymentDir)
	def codes = ['blue':'', 'green':'-green']

	if (currentDeployment == 'blue' || currentDeployment == 'green') {
		return codes.get(currentDeployment)
	}
	return 'Error'
}

// Pipeline Stages
pipeline {
	agent any
	environment {
		CLOUD_REGISTRY   = credentials('CLOUD_REGISTRY')
		PROJECT          = credentials('PROJECT')
		BASIC_AUTH_USER	 = credentials('BASIC_AUTH_USER')
		BASIC_AUTH_PASS  = credentials('BASIC_AUTH_PASS')
	}
	stages {
		stage('SCM') {
			steps {
				checkout([$class: 'GitSCM', branches: [[name: '*/master']], doGenerateSubmoduleConfigurations: false, extensions: [], submoduleCfg: [], userRemoteConfigs: [[credentialsId: 'repo-jenkins-key', url: 'git@github.com:RonieGSS/k8_jenkins_cakephp.git']]])
			}
		}
		stage('Build Original Image') {
			steps {
				sh("cp src/cakephp/config/app.prod.php src/cakephp/config/app.php")
				sh("chmod -R 777 src/cakephp/tmp")
				sh("chmod -R 777 src/cakephp/logs")
				script {
					docker.build("hxhroniegss/cakephp3", "./ops/docker/original/cakephp")
				}	
			}
		}
		stage('Build Node Modules') {
			steps {
				echo "Production script"
				sh("touch ./src/index.js")
				script {
					docker.image('hxhroniegss/webpack:latest').withRun("-v $WORKSPACE:/workspace") { c ->
						sh 'cd src/front; npm install'
					}
					docker.image('qmu1/webpack:latest').withRun("-e NODE_ENV=production -v $WORKSPACE:/workspace") { c ->
						sh 'cd src/front; webpack \
					         --env.production \
					         --mode=production \
					         --optimize-dedupe \
					         --optimize-occurrence-order \
					         --optimize-max-chunks 15 \
					         --optimize-min-chunk-size 10000 \
					         --optimize-minimize'
					}
				}
			}
		}
		stage('Build and Push Production Images') {
			environment {
		        FRONT_URL              = credentials('FRONT_URL')
		        CAKE_KEY               = credentials('CAKE_KEY')
		        FB_APP_ID              = credentials('FB_APP_ID')
		        FB_APP_SECRET          = credentials('FB_APP_SECRET')
		        GOOGLE_CLIENT_ID       = credentials('GOOGLE_CLIENT_ID')
		        TWITTER_API_KEY        = credentials('TWITTER_API_KEY')
		        TWITTER_API_SECRET     = credentials('TWITTER_API_SECRET')
		        FREEE_API_KEY          = credentials('FREEE_API_KEY')
		        FREEE_API_SECRET       = credentials('FREEE_API_SECRET')
		        MFCLOUD_API_KEY        = credentials('MFCLOUD_API_KEY')
		        MFCLOUD_API_SECRET     = credentials('MFCLOUD_API_SECRET')
		        MISOCA_API_KEY         = credentials('MISOCA_API_KEY')
		        MISOCA_API_SECRET      = credentials('MISOCA_API_SECRET')
		        MONEYTREE_API_KEY      = credentials('MONEYTREE_API_KEY')
		        MONEYTREE_API_SECRET   = credentials('MONEYTREE_API_SECRET')
		        RECAPTCHA_SITE_KEY     = credentials('RECAPTCHA_SITE_KEY')
		        RECAPTCHA_SECRET       = credentials('RECAPTCHA_SECRET')
		        TWILIO_SID             = credentials('TWILIO_SID')
		        TWILIO_TOKEN           = credentials('TWILIO_TOKEN')
		        TWILIO_VOICE_MFA_URL   = credentials('TWILIO_VOICE_MFA_URL')
		        SEND_GRID_API_KEY      = credentials('SEND_GRID_API_KEY')
		        COMPANY_NUMBER_API_KEY = credentials('COMPANY_NUMBER_API_KEY')
		        BOARD_API_KEY          = credentials('BOARD_API_KEY')
		        BOARD_API_SECRET       = credentials('BOARD_API_SECRET')
		    }
		    steps {
		    	echo "Production CakePHP3 Image"
		   		sh("cp $WORKSPACE/ops/docker/production/cakephp/Dockerfile $WORKSPACE")
		    	script {
		    		withDockerRegistry(credentialsId: 'gcr:template', url: "https://$CLOUD_REGISTRY") {
		    			// Build and push fluentd images
		    			def fluentdImage = docker.build("$CLOUD_REGISTRY/fluentd", "./ops/docker/production/fluentd")
			    		fluentdImage.push()
			    		// Build and push cakephp image
			    		def productionImage = docker.build("$CLOUD_REGISTRY/cakephp3", "\
			    			--no-cache \
			    			--build-arg FB_APP_ID=$FB_APP_ID \
			    			--build-arg CAKE_KEY=$CAKE_KEY \
			    			--build-arg FB_APP_SECRET=$FB_APP_SECRET \
			    			--build-arg GOOGLE_CLIENT_ID=$GOOGLE_CLIENT_ID \
			    			--build-arg TWITTER_API_KEY=$TWITTER_API_KEY \
			    			--build-arg TWITTER_API_SECRET=$TWITTER_API_SECRET \
			    			--build-arg FREEE_API_KEY=$FREEE_API_KEY \
			    			--build-arg FREEE_API_SECRET=$FREEE_API_SECRET \
			    			--build-arg MFCLOUD_API_KEY=$MFCLOUD_API_KEY \
			    			--build-arg MFCLOUD_API_SECRET=$MFCLOUD_API_SECRET \
			    			--build-arg MISOCA_API_KEY=$MISOCA_API_KEY \
			    			--build-arg MISOCA_API_SECRET=$MISOCA_API_SECRET \
			    			--build-arg MONEYTREE_API_KEY=$MONEYTREE_API_KEY \
			    			--build-arg MONEYTREE_API_SECRET=$MONEYTREE_API_SECRET \
			    			--build-arg TWILIO_SID=$TWILIO_SID \
			    			--build-arg TWILIO_TOKEN=$TWILIO_TOKEN \
			    			--build-arg TWILIO_VOICE_MFA_URL=$TWILIO_VOICE_MFA_URL \
			    			--build-arg SEND_GRID_API_KEY=$SEND_GRID_API_KEY \
			    			--build-arg COMPANY_NUMBER_API_KEY=$COMPANY_NUMBER_API_KEY \
			    			--build-arg BOARD_API_KEY=$BOARD_API_KEY \
			    			--build-arg BOARD_API_SECRET=$BOARD_API_SECRET \
			    			--build-arg URL=$FRONT_URL \
			    			--build-arg RECAPTCHA_SITE_KEY=$RECAPTCHA_SITE_KEY \
			    			--build-arg RECAPTCHA_SECRET=$RECAPTCHA_SECRET \
			    			-f ./ops/docker/production/cakephp/Dockerfile ./")

			    		productionImage.push()
			    	}
		    	}
		    	// Remove images
		    	sh("docker rmi $CLOUD_REGISTRY/fluentd")
		    	sh("docker rmi $CLOUD_REGISTRY/cakephp3")
		    }
		} 
		stage('Staging Deployment') {
			when {
				not {
					anyOf {
						equals expected: 'Error', actual: getSwitchCode('staging');
						equals expected: 'Error', actual: getDeploymentCode('staging')
					}
				}
			}
			environment {
				KUBERNETES_IP      = credentials('KUBERNETES_IP')
				STAGING_URL_IP     = credentials('STAGING_URL_IP')
			}
			steps {
				script {
					withKubeConfig(credentialsId: 'kubernetes-user-pass', serverUrl: "https://$KUBERNETES_IP") {
						sh("kubectl get pods")
						/**
					 	 *
					 	 * Setup for Blue/Green Deployment
					 	 *
						 */
						echo "Start Blue/Green Deployment"

						/**
						 *
						 * Staging Deployment
						 *
						 */
						 def env                       = 'staging'
						 def dir                       = 'staging/cakephp'
						 def switchCode                = getSwitchCode('staging')
						 def deploymentCode            = getDeploymentCode('staging')
						 def switchToServiceLabel      = "${app}${switchCode}"
						 def deployServiceLabel        = "${app}${deploymentCode}"

						 // Switch Traffic to Another CakePHP Service
						sh("LOAD_BALANCER=$STAGING_URL_IP \
							envsubst < ./ops/docker/${dir}/service.yaml | kubectl patch \
							-p '{\"spec\":{\"selector\": {\"app\": \"${switchToServiceLabel}-${env}\"}}}' -f -")

						// Switch labels of https pod
						sh("kubectl label pod https-${app} app=${switchToServiceLabel}-${env} --overwrite")

						// CakePHP Deployment
						sh("kubectl set image deployment/${deployServiceLabel} cakephp3=$CLOUD_REGISTRY/${app}:latest")

						// Check rollout status of deployment until success
						sh("kubectl rollout status deploy/${deployServiceLabel}")
						
						// Switch to Updated CakePHP Service
						sh("LOAD_BALANCER=$STAGING_URL_IP \
							envsubst < ./ops/docker/${dir}/service.yaml | kubectl patch \
							-p '{\"spec\":{\"selector\": {\"app\": \"${deployServiceLabel}-${env}\"}}}' -f -")

						// Switch back labels of https pod
						sh("kubectl label pod https-${app} app=${deployServiceLabel}-${env} --overwrite")
					} // withKubeConfig end
				} // script end
			} // steps end
		}
		stage('Production Deployment') {
			when {
				not {
					anyOf {
						equals expected: 'Error', actual: getSwitchCode('production');
						equals expected: 'Error', actual: getDeploymentCode('production')
					}
				}
			}
			environment {
				KUBERNETES_IP         = credentials('PROD_KUBERNETES_IP')
				PRODUCTION_URL_IP     = credentials('PROD_URL_IP')
			}
			steps {
				script {
					withKubeConfig(credentialsId: 'kube_prod_user_pass', serverUrl: "https://$KUBERNETES_IP") {
						sh("kubectl get pods")
						/**
						 *
						 * Setup for Blue/Green Deployment
						 *
						 */
						echo "Blue/Green Deployment"

						/**
						 *
						 * Production Deployment
						 *
						 */
						 def env                       = 'prod'
						 def dir                       = 'production/cakephp'
						 def switchCode                = getSwitchCode('production')
						 def deploymentCode            = getDeploymentCode('production')
						 def switchToServiceLabel      = "${app}${switchCode}"
						 def deployServiceLabel        = "${app}${deploymentCode}"

						 // Switch Traffic to Another CakePHP Service
						sh("LOAD_BALANCER=$PRODUCTION_URL_IP \
							envsubst < ./ops/docker/${dir}/service.yaml | kubectl patch \
							-p '{\"spec\":{\"selector\": {\"app\": \"${switchToServiceLabel}-${env}\"}}}' -f -")

						// Switch labels of https pod
						sh("kubectl label pod https-${app} app=${switchToServiceLabel}-${env} --overwrite")

						// CakePHP Deployment
						sh("kubectl set image deployment/${deployServiceLabel} cakephp3=$CLOUD_REGISTRY/${app}:latest")

						// Check rollout status of deployment until success
						sh("kubectl rollout status deploy/${deployServiceLabel}")
						
						// Switch to Updated CakePHP Service
						sh("LOAD_BALANCER=$PRODUCTION_URL_IP \
							envsubst < ./ops/docker/${dir}/service.yaml | kubectl patch \
							-p '{\"spec\":{\"selector\": {\"app\": \"${deployServiceLabel}-${env}\"}}}' -f -")

						// Switch back labels of https pod
						sh("kubectl label pod https-${app} app=${deployServiceLabel}-${env} --overwrite")
					}
				}
			}	
		}
	} // stages end
} // pipeline end
