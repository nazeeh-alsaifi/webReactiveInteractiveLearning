<template>
  <div>
    <Video1V
      v-if="name == 'Video'"
      :options="formateOptions"
      :source="formateSource"
    />
    <ChartAndTable v-if="name == 'Sheet and a chart'" />
    <TableOnly v-if="name == 'Sheet only'" />
    <MultiQuestion
      v-if="name == 'Multi Question'"
      :sectioncomponentid="sectioncomponentid"
    />
    <EndQuestion
      v-if="name == 'End_question'"
      :data="endQuestionData"
    ></EndQuestion>
  </div>
</template>

<script>
import ChartAndTable from "./ChartAndTable";
import Video1V from "./Video1V";
import TableOnly from "./TableOnly";
import MultiQuestion from "./MultiQuestion";
import EndQuestion from "./EndQuestion.vue";
import axios from "axios";

export default {
  name: "ActivityComponent",
  components: {
    ChartAndTable,
    Video1V,
    TableOnly,
    MultiQuestion,
    EndQuestion,
  },
  props: {
    name: String,
    options: Object,
    sectioncomponentid: Number,
  },

  mounted() {
    console.log("section_component_id:", this.sectioncomponentid);
    if (this.name == "Video") {
      console.log("options:", this.options);
      console.log(this.$apiAdress + "/" + this.options.video_src);
    }
    if (this.name == "End_question") {
      this.loadEndQuestion();
    }
  },
  computed: {
    formateSource() {
      if (this.name == "Video") {
        if (this.options != null) {
          return {
            id: "video-1",
            src: this.$apiAdress + this.options.video_src,
            // poster: require("@/assets/player_assets/bunny.png"),
            type: "video/mp4",
            dataSetup: "{}",
          };
        }
      } else {
        return {
          id: "video-1",
          src: require("@/assets/player_assets/bunny.mp4"),
          // poster: require("@/assets/player_assets/bunny.png"),
          type: "video/mp4",
          dataSetup: "{}",
        };
      }
    },
    formateOptions() {
      if (this.name == "Video") {
        if (this.options != null) {
          var options_obj = {
            autoplay: false,
            controls: true,
            // BottomSheet: true,
            controlBar: {
              children: {
                SkipBackwardButton: { fps: this.options.fps },
                playToggle: true,
                SkipForwardButton: { fps: this.options.fps },
                CurrentTimeDisplay: true,
                ProgressControl: { liveui: true },
                RemainingTimeDisplay: true,
                FullscreenToggle: true,
              },
            },
            ToolsWrapper: {
              children: {
                ToolsParentButton: true,
                ToolsToggler: {
                  children: {
                    //  TimerButton: true
                  },
                },
              },
            },
            // TimerMoveable: {
            //   children: {
            //     TimerDetailsWrapper: {
            //       children: {
            //         TimerVideoDetails: {
            //           children: {
            //             MyTimeDisplay: true,
            //             MyFrameDisplay: { fps: this.options.fps },
            //             MyFpsDisplay: { fps: this.options.fps },
            //           },
            //         },
            //         ResetTimer: true,
            //       },
            //     },
            //   },
            // },
          };
          this.options.tools.forEach((tool) => {
            if (tool == "Protactor") {
              const protactor_obj = {
                ProtactorWrapper: {
                  // src: require("@/assets/player_assets/protactor.svg"),
                  src: this.$apiAdress + "/player_tools/protactor180.svg",
                },
              };
              options_obj = Object.assign(options_obj, protactor_obj);
              options_obj.ToolsWrapper.children.ToolsToggler.children[
                "ProtactorToolButton"
              ] = true;
            }
            if (tool == "Ruler") {
              const ruler_obj = {
                RulerWrapper: {
                  // src: require("@/assets/player_assets/exportedRuler2.svg"),
                  src: this.$apiAdress + "/player_tools/exportedRuler2.svg",
                },
              };
              options_obj = Object.assign(options_obj, ruler_obj);
              options_obj.ToolsWrapper.children.ToolsToggler.children[
                "RulerToolButton"
              ] = true;
            }
            if (tool == "Timer") {
              const timer_obj = {
                TimerMoveable: {
                  children: {
                    TimerDetailsWrapper: {
                      children: {
                        TimerVideoDetails: {
                          children: {
                            MyTimeDisplay: true,
                            MyFrameDisplay: { fps: this.options.fps },
                            MyFpsDisplay: { fps: this.options.fps },
                          },
                        },
                        ResetTimer: true,
                      },
                    },
                  },
                },
              };
              options_obj = Object.assign(options_obj, timer_obj);
              options_obj.ToolsWrapper.children.ToolsToggler.children[
                "TimerButton"
              ] = true;
            }
          });
          return options_obj;
        } else {
          return {
            autoplay: false,
            controls: true,
            // BottomSheet: true,
            controlBar: {
              children: {
                SkipBackwardButton: { fps: 25 },
                playToggle: true,
                SkipForwardButton: { fps: 25 },
                CurrentTimeDisplay: true,
                ProgressControl: { liveui: true },
                RemainingTimeDisplay: true,
                FullscreenToggle: true,
              },
            },
          };
        }
      }
    },
  },
  methods: {
    loadEndQuestion() {
      axios
        .get(
          this.$apiAdress +
            "/api/Employees/" +
            this.sectioncomponentid +
            "/getEndQuestionData?token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          console.log(response);
          this.endQuestionData = response.data.questionData;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
  data() {
    return {
      endQuestionData: null,
    };
  },
};
</script>

<style>
</style>