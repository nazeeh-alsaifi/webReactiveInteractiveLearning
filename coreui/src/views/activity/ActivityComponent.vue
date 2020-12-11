<template>
  <div>
    <Video1V v-if="name == 'Video'" :options="formateOptions" />
    <ChartAndTable v-if="name == 'Sheet and a chart'" />
    <TableOnly v-if="name == 'Sheet only'" />
  </div>
</template>

<script>
import ChartAndTable from "./ChartAndTable";
import Video1V from "./Video1V";
import TableOnly from "./TableOnly";
export default {
  name: "ActivityComponent",
  components: {
    ChartAndTable,
    Video1V,
    TableOnly,
  },
  props: {
    name: String,
    options: Object,
  },

  mounted() {},
  computed: {
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
                  children: { TimerButton: true },
                },
              },
            },
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
  methods: {},
  data() {
    return {};
  },
};
</script>

<style>
</style>