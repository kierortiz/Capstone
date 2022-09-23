// pannellum.viewer('panorama', {
//     "type": "equirectangular",
//     "compass": true,
//     "autoLoad": true,
//     "autoRotate": -10,
//     "hfov": 80,
//     "vaov": 62,
//     "autoRotateInactivityDelay": 3000,
//     "maxLevel": 16,
//     "panorama": "assets/panorama/sample.jpg",
// });


// pannellum.viewer('panorama', {
//             "type": "equirectangular",
//             "panorama": "assets/panorama/sample.jpg",
//             "autoLoad": true,
//             "autoRotate": -2,
//             "hfov": 80,
//             "vaov": 62,
//             "vOffset": 0,
//             "minPitch": 0,
//             "maxPitch": 0,
//             "pitch": 0,
//             "showZoomCtrl": false,
//             "keyboardZoom": false,
//             "mouseZoom": false,
//             "minHfov":100,
//             "maxHfov":100,
//             "hotSpotDebug": true
//   },
// );


  // pannellum.viewer('panorama', {
  //     "type": "equirectangular",
  //     "panorama": "assets/panorama/Science_lab.jpg",
  //     "autoLoad": true,
  //     "haov": 180,
  //     "vaov": 62,
  //     "minYaw": -76.935,
  //     "maxYaw": 76.935,
  //     "minPitch": -27.905,
  //     "maxPitch": 30.245,
  //     "showZoomCtrl": false,
  //     "mouseZoom": false,
  //     "keyboardZoom": false,
  //     "hfov": 80,
  //     "orientationOnByDefault": true,
  //     "hotSpotDebug": true
  // });




  pannellum.viewer('panorama', {
      "default": {
          "firstScene": "1",
          "sceneFadeDuration": 1000,
            "autoLoad": true,
            "author": "St. Andrew's Cleverland School",
      },

      "scenes": {

          "1": {
              "title": "School Ground 1",
              "hfov": 120,
              "type": "equirectangular",
              "panorama": "assets/panorama/1.jpg",
              "hotSpots": [
                  {
                      "pitch": -9.91964807182761,
                      "yaw": -0.4041229678373581,
                      "type": "scene",
                      "text": "School Ground 2",
                      "sceneId": "2"
                  },

                  {
                      "pitch": 11.389152966128128,
                      "yaw": -101.067991110571,
                      "type": "scene",
                      "text": "Stair 1",
                      "sceneId": "10"
                  },

              ]
          },

          "2": {
              "title": "School Ground 2",
              "hfov": 120,
              "type": "equirectangular",
              "panorama": "assets/panorama/2.jpg",
              "hotSpots": [
                  {
                      "pitch": -1.061081734730235,
                      "yaw": -169.3596307170694,
                      "type": "scene",
                      "text": "School Ground 1",
                      "sceneId": "1"
                  },

                  {
                      "pitch": -12.66452000160325,
                      "yaw": 107.81581193592686,
                      "type": "scene",
                      "text": "Office Hall",
                      "sceneId": "3"
                  },

                  {
                      "pitch": -9.91964807182761,
                      "yaw": -0.4041229678373581,
                      "type": "scene",
                      "text": "School Ground 3",
                      "sceneId": "5"
                  }
              ]
          },

          "3": {
              "title": "Office Hall",
              "hfov": 120,
              "type": "equirectangular",
              "panorama": "assets/panorama/3.jpg",
              "hotSpots": [
                  {
                      "pitch": 7.163476843781344,
                      "yaw": 42.04372927714001,
                      "type": "scene",
                      "text": "Science Laboratory",
                      "sceneId": "4"
                  },

                  {
                      "pitch": -18.13143996831455,
                      "yaw": -171.2301055847956,
                      "type": "scene",
                      "text": "School Ground 2",
                      "sceneId": "2"
                  }

              ]
          },

          "4": {
              "title": "Science Laboratory",
              "hfov": 120,
              "type": "equirectangular",
              "panorama": "assets/panorama/4.jpg",
              "hotSpots": [
                  {
                      "pitch": 7.163476843781344,
                      "yaw": 42.04372927714001,
                      "type": "scene",
                      "text": "Office Hall",
                      "sceneId": "3"
                  }
              ]
          },

          "5": {
              "title": "School Ground 3",
              "hfov": 120,
              "type": "equirectangular",
              "panorama": "assets/panorama/5.jpg",
              "hotSpots": [
                  {
                      "pitch": 6.758697898322656,
                      "yaw": -79.39510576871095,
                      "type": "scene",
                      "text": "Computer Laboratory",
                      "sceneId": "6"
                  },

                  {
                      "pitch": -12.33385133479409,
                      "yaw": -1.7124568732511913,
                      "type": "scene",
                      "text": "School Ground 4",
                      "sceneId": "7"
                  },

                  {
                      "pitch": -10.608958403457589,
                      "yaw": -167.38277042205388,
                      "type": "scene",
                      "text": "School Ground 2",
                      "sceneId": "2"
                  }
              ]
          },

          "6": {
              "title": "Computer Laboratory",
              "hfov": 120,
              "type": "equirectangular",
              "panorama": "assets/panorama/6.jpg",
              "hotSpots": [
                  {
                      "pitch": 2.603662025299349,
                      "yaw": -147.26739562585445,
                      "type": "scene",
                      "text": "School Ground 3",
                      "sceneId": "5"
                  }
              ]
          },

          "7": {
              "title": "School Ground 4",
              "hfov": 120,
              "type": "equirectangular",
              "panorama": "assets/panorama/7.jpg",
              "hotSpots": [
                  {
                      "pitch": -0.8558323770384788,
                      "yaw": -5.524431101806076,
                      "type": "scene",
                      "text": "Stage",
                      "sceneId": "8"
                  },

                  {
                      "pitch": -8.34760009816012,
                      "yaw": 75.5169140879895,
                      "type": "scene",
                      "text": "Court",
                      "sceneId": "9"
                  },

                  {
                      "pitch": -3.375365866108464,
                      "yaw": -175.4063073384857,
                      "type": "scene",
                      "text": "School Ground 3",
                      "sceneId": "5"
                  }
              ]
          },

          "8": {
              "title": "Stage",
              "hfov": 120,
              "type": "equirectangular",
              "panorama": "assets/panorama/8.jpg",
              "hotSpots": [
                  {
                      "pitch": -16.773246603552323,
                      "yaw": 10.391148505258068,
                      "type": "scene",
                      "text": "School Ground 4",
                      "sceneId": "7"
                  }
              ]
          },

          "9": {
              "title": "Court",
              "hfov": 120,
              "type": "equirectangular",
              "panorama": "assets/panorama/9.jpg",
              "hotSpots": [
                  {
                      "pitch": -8.857752098156377,
                      "yaw": -176.6214605908268,
                      "type": "scene",
                      "text": "School Ground 4",
                      "sceneId": "7"
                  }
              ]
          },

          "10": {
              "title": "Stair 1",
              "hfov": 120,
              "type": "equirectangular",
              "panorama": "assets/panorama/10.jpg",
              "hotSpots": [
                  {
                      "pitch": 9.86374511117741,
                      "yaw": -10.514636031219327,
                      "type": "scene",
                      "text": "2nd Floor Hallway",
                      "sceneId": "11"
                  },

                  {
                      "pitch": 9.86374511117741,
                      "yaw": -5.150021989265193,
                      "type": "scene",
                      "text": "Stair 2",
                      "sceneId": "12"
                  },

                  {
                      "pitch": -27.779203585490837,
                      "yaw": 18.04486550023035,
                      "type": "scene",
                      "text": "School Ground 1",
                      "sceneId": "1"
                  }
              ]
          },

          "11": {
              "title": "2nd Floor Hallway",
              "hfov": 120,
              "type": "equirectangular",
              "panorama": "assets/panorama/11.jpg",
              "hotSpots": [
                  {
                      "pitch": -3.6609396739322446,
                      "yaw": -173.21258657967428,
                      "type": "scene",
                      "text": "Stair 2",
                      "sceneId": "12"
                  },

                  {
                      "pitch": -15.046032592467832,
                      "yaw": -170.38161020760631,
                      "type": "scene",
                      "text": "Stair 2",
                      "sceneId": "10"
                  },
              ]
          },

          "12": {
              "title": "Stair 2",
              "hfov": 120,
              "type": "equirectangular",
              "panorama": "assets/panorama/12.jpg",
              "hotSpots": [
                  {
                      "pitch": -32.78942176315501,
                      "yaw": 15.220656403649356,
                      "type": "scene",
                      "text": "2nd Floor Hallway",
                      "sceneId": "11"
                  },

                  {
                      "pitch": 10.933622693875378,
                      "yaw": -14.789120916665626,
                      "type": "scene",
                      "text": "3rd Floor Hallway",
                      "sceneId": "13"
                  },

                  {
                      "pitch": -37.422923781710416,
                      "yaw": 15.96223062266567,
                      "type": "scene",
                      "text": "Stair 1",
                      "sceneId": "10"
                  }
              ]
          },

          "13": {
              "title": "3rd Floor Hallway",
              "hfov": 120,
              "type": "equirectangular",
              "panorama": "assets/panorama/13.jpg",
              "hotSpots": [
                  {
                      "pitch": -10.136926481512116,
                      "yaw": -168.54904022705733,
                      "type": "scene",
                      "text": "Stair 2",
                      "sceneId": "12"
                  }
              ]
          },

      }
  });
