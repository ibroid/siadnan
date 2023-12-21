<div class="container-fluid ">
	<div class="row">
		<div class="col-12 p-0">
			<div>
				<div class="theme-form">
					<div class="wizard-4" id="wizard">
						<ul>
							<li>
								<a href="<?= base_url("/pengajuan/pegawai/$jenis_pengajuan->id") ?>" class="btn btn-outline">
									<i class="fa fa-arrow-left"></i>
									Kembali
								</a>
							</li>
							<?php foreach ($jenis_pengajuan->persyaratan as $n => $p) { ?>
								<li>
									<a href="#step-<?= ++$n ?>">
										<h4>
											<?= $n ?>
										</h4>
										<h5>
											<?= $p->persyaratan ?>
										</h5><small>Lengkapi untuk melanjutkan</small>
									</a>
								</li>
							<?php } ?>

							<li> <img src="<?= base_url() ?>assets/images/login/icon.png" alt="looginpage"></li>
						</ul>
						<?php foreach ($jenis_pengajuan->persyaratan as $n => $p) { ?>
							<div id="step-<?= ++$n ?>">
								<div class="wizard-title">
									<h2>
										<?= $p->persyaratan ?>
									</h2>
									<h5 class="text-muted mb-4">
										<?= $p->detail ?>
									</h5>
								</div>
								<div class="login-main" style="width:800px">
									<div class="theme-form">
										<div class="row class-content" id="class-content-p<?= $p->id ?>">
											<div class="col-sm-6">
												<div class="form-group">
													<label for="name">Upload Disini.
														Maksimal
														<?= $p->max_size ?> KB
													</label>
													<form class="dropzone dz-clickable" id="singleFileUpload" action="<?= base_url("wizard/save_persyaratan") ?>" method="POST" enctype="multipart/form-data">
														<input type="hidden" name="persyaratan_id" value="<?= $p->id ?>">
														<input type="hidden" name="pegawai_id" value="<?= $pengajuan->pegawai_id ?>">
														<input type="hidden" name="pengajuan_id" value="<?= $pengajuan->id ?>">
														<div class="dropzone-wrapper">
															<div class="dz-message needsclick"><i class="icon-cloud-up"></i>
																<h6>Drop files here or click to upload.</h6><span class="note needsclick"></span>
															</div>
														</div>
													</form>
												</div>
											</div>
											<?= $this->load->component("pengajuan/riwayat_upload", [
												"p" => PersyaratanPengajuanEntity::where([
													"pegawai_id" => $pengajuan->pegawai_id,
													"persyaratan_id" => $p->id,
													"pengajuan_id" => $pengajuan->id
												])->get()
											]) ?>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
	document.addEventListener("DOMContentLoaded", () => {
		async function fetchRiwayatUpload() {
			$.ajax({
				url: "<?= base_url("pengajuan/riwayat_upload") ?>",
				method: "POST",
				accepts: "text/html",
				processData: false,
				contentType: false,
				success(html) {
					$(".class-content").each((i, e) => {
						$(e).append(html)
					})
				},
				error(error) {
					Swal.fire("Terjadi kesalahan", error.responseText, "error")
				}
			})
		}

		(function() {
			var DropzoneExample = (function() {
				var DropzoneDemos = function() {
					Dropzone.options.singleFileUpload = {
						paramName: "file",
						maxFiles: 1,
						acceptedFiles: "application/pdf",
						addRemoveLinks: true,
						/**
						 * @param {File} file
						 * @param {Function} done
						 */
						accept(file, done) {
							if (file.type !== "application/pdf") {
								return done(new Error("Failed"))
							}
							return done()
						},
						init() {
							this.on("error", (file, message) => {
								Swal.fire("Terjadi Kesalahan", message, "error")
							});

							this.on("success", (file, message) => {
								const data = JSON.parse(message);

								Swal.fire("Upload Berhasil", "", "success")
								$(`#class-content-p${data[1]} > div:nth-child(2)`).replaceWith(data[0])
								// $(`#class-content-p${data[1]}`).append(data[0])
								// $("#button-next").attr("disabled")
								initDeleteEvent()
							});
						}
					};
				};
				return {
					init: function() {
						DropzoneDemos();
					},
				};
			})();
			DropzoneExample.init();
		})();

		(function($) {
			(function(a) {
				a.fn.smartWizard = function(m) {
					var c = a.extend({}, a.fn.smartWizard.defaults, m),
						x = arguments;
					return this.each(function() {
						function C() {
							var e = b.children("div");
							b.children("ul").addClass("anchor");
							e.addClass("content");
							n = a("<div>Loading</div>").addClass("loader");
							k = a("<div></div>").addClass("action-bar");
							p = a("<div></div>").addClass("step-container login-card");
							q = a("<a>" + c.labelNext + "</a>")
								.attr("href", "#")
								.addClass("btn btn-primary");
							r = a("<a>" + c.labelPrevious + "</a>")
								.attr("href", "#")
								.addClass("btn btn-primary");
							s = a("<a>" + c.labelFinish + "</a>")
								.attr("href", "#")
								.addClass("btn btn-primary");
							c.errorSteps &&
								0 < c.errorSteps.length &&
								a.each(c.errorSteps, function(a, b) {
									y(b, !0);
								});
							p.append(e);
							k.append(n);
							b.append(p);
							b.append(k);
							c.includeFinishButton && k.append(s);
							k.append(q).append(r);
							z = p.width();
							a(q).click(function() {
								if (a(this).hasClass("buttonDisabled")) return !1;
								A();
								return !1;
							});
							a(r).click(function() {
								if (a(this).hasClass("buttonDisabled")) return !1;
								B();
								return !1;
							});
							a(s).click(function() {
								if (!a(this).hasClass("buttonDisabled"))
									if (a.isFunction(c.onFinish)) c.onFinish.call(this, a(f));
									else {
										var d = b.parents("form");
										d && d.length && d.submit();
									}
								return !1;
							});
							a(f).bind("click", function(a) {
								if (f.index(this) == h) return !1;
								a = f.index(this);
								1 == f.eq(a).attr("isDone") - 0 && t(a);
								return !1;
							});
							c.keyNavigation &&
								a(document).keyup(function(a) {
									39 == a.which ? A() : 37 == a.which && B();
								});
							D();
							t(h);
						}

						function D() {
							c.enableAllSteps ?
								(a(f, b)
									.removeClass("selected")
									.removeClass("disabled")
									.addClass("done"),
									a(f, b).attr("isDone", 1)) :
								(a(f, b)
									.removeClass("selected")
									.removeClass("done")
									.addClass("disabled"),
									a(f, b).attr("isDone", 0));
							a(f, b).each(function(e) {
								a(a(this).attr("href"), b).hide();
								a(this).attr("rel", e + 1);
							});
						}

						function t(e) {
							var d = f.eq(e),
								g = c.contentURL,
								h = d.data("hasContent");
							stepNum = e + 1;
							g && 0 < g.length ?
								c.contentCache && h ?
								w(e) :
								a.ajax({
									url: g,
									type: "POST",
									data: {
										step_number: stepNum,
									},
									dataType: "text",
									beforeSend: function() {
										n.show();
									},
									error: function() {
										n.hide();
									},
									success: function(c) {
										n.hide();
										c &&
											0 < c.length &&
											(d.data("hasContent", !0),
												a(a(d, b).attr("href"), b).html(c),
												w(e));
									},
								}) :
								w(e);
						}

						function w(e) {
							var d = f.eq(e),
								g = f.eq(h);
							if (
								e != h &&
								a.isFunction(c.onLeaveStep) &&
								!c.onLeaveStep.call(this, a(g))
							)
								return !1;
							c.updateHeight && p.height(a(a(d, b).attr("href"), b).outerHeight());
							if ("slide" == c.transitionEffect)
								a(a(g, b).attr("href"), b).slideUp("fast", function(c) {
									a(a(d, b).attr("href"), b).slideDown("fast");
									h = e;
									u(g, d);
								});
							else if ("fade" == c.transitionEffect)
								a(a(g, b).attr("href"), b).fadeOut("fast", function(c) {
									a(a(d, b).attr("href"), b).fadeIn("fast");
									h = e;
									u(g, d);
								});
							else if ("slideleft" == c.transitionEffect) {
								var k = 0;
								e > h ?
									((nextElmLeft1 = z + 10),
										(nextElmLeft2 = 0),
										(k = 0 - a(a(g, b).attr("href"), b).outerWidth())) :
									((nextElmLeft1 =
											0 - a(a(d, b).attr("href"), b).outerWidth() + 20),
										(nextElmLeft2 = 0),
										(k = 10 + a(a(g, b).attr("href"), b).outerWidth()));
								e == h ?
									((nextElmLeft1 = a(a(d, b).attr("href"), b).outerWidth() + 20),
										(nextElmLeft2 = 0),
										(k = 0 - a(a(g, b).attr("href"), b).outerWidth())) :
									a(a(g, b).attr("href"), b).animate({
											left: k,
										},
										"fast",
										function(e) {
											a(a(g, b).attr("href"), b).hide();
										}
									);
								a(a(d, b).attr("href"), b).css("left", nextElmLeft1);
								a(a(d, b).attr("href"), b).show();
								a(a(d, b).attr("href"), b).animate({
										left: nextElmLeft2,
									},
									"fast",
									function(a) {
										h = e;
										u(g, d);
									}
								);
							} else
								a(a(g, b).attr("href"), b).hide(),
								a(a(d, b).attr("href"), b).show(),
								(h = e),
								u(g, d);
							return !0;
						}

						function u(e, d) {
							a(e, b).removeClass("selected");
							a(e, b).addClass("done");
							a(d, b).removeClass("disabled");
							a(d, b).removeClass("done");
							a(d, b).addClass("selected");
							a(d, b).attr("isDone", 1);
							c.cycleSteps ||
								(0 >= h ?
									a(r).addClass("buttonDisabled") :
									a(r).removeClass("buttonDisabled"),
									f.length - 1 <= h ?
									a(q).addClass("buttonDisabled") :
									a(q).removeClass("buttonDisabled"));
							!f.hasClass("disabled") || c.enableFinishButton ?
								a(s).removeClass("buttonDisabled") :
								a(s).addClass("buttonDisabled");
							if (a.isFunction(c.onShowStep) && !c.onShowStep.call(this, a(d)))
								return !1;
						}

						function A() {
							var a = h + 1;
							if (f.length <= a) {
								if (!c.cycleSteps) return !1;
								a = 0;
							}
							t(a);
						}

						function B() {
							var a = h - 1;
							if (0 > a) {
								if (!c.cycleSteps) return !1;
								a = f.length - 1;
							}
							t(a);
						}

						function E(b) {
							a(".content", l).html(b);
							l.show();
						}

						function y(c, d) {
							d
								?
								a(f.eq(c - 1), b).addClass("error") :
								a(f.eq(c - 1), b).removeClass("error");
						}
						var b = a(this),
							h = c.selected,
							f = a("ul > li > a[href^='#step-']", b),
							z = 0,
							n,
							l,
							k,
							p,
							q,
							r,
							s;
						k = a(".action-bar", b);
						0 == k.length && (k = a("<div></div>").addClass("action-bar"));
						l = a(".msg-box", b);
						0 == l.length &&
							((l = a(
									'<div class="msg-box"><div class="content"></div><a href="#" class="close"><i class="icofont icofont-close-line-circled"></i></a></div>'
								)),
								k.append(l));
						a(".close", l).click(function() {
							l.fadeOut("normal");
							return !1;
						});
						if (m && "init" !== m && "object" !== typeof m) {
							if ("showMessage" === m) {
								var v = Array.prototype.slice.call(x, 1);
								E(v[0]);
								return !0;
							}
							if ("setError" === m)
								return (
									(v = Array.prototype.slice.call(x, 1)),
									y(v[0].stepnum, v[0].iserror),
									!0
								);
							a.error("Method " + m + " does not exist");
						} else C();
					});
				};
				a.fn.smartWizard.defaults = {
					selected: 0,
					keyNavigation: !0,
					enableAllSteps: !1,
					updateHeight: !0,
					transitionEffect: "fade",
					contentURL: null,
					contentCache: !0,
					cycleSteps: !1,
					includeFinishButton: !0,
					enableFinishButton: !1,
					errorSteps: [],
					labelNext: "Next",
					labelPrevious: "Previous",
					labelFinish: "Finish",
					onLeaveStep: null,
					onShowStep: null,
					onFinish: null,
				};
			})(jQuery);

			$("#wizard").smartWizard({
				transitionEffect: "slideleft",
				onFinish: onFinishCallback,
			});

			async function onFinishCallback() {
				// $("#wizard").smartWizard("showMessage", "Pengajuan berhasil disimpan. Silahkan tunggu 3 detik");
				const {
					isConfirmed
				} = await Swal.fire({
					title: "Apa berkas sudah lengkap ?",
					text: "Setelah ini berkas tidak bisa di ubah lagi",
					confirmButtonText: "Yakin",
					showCancelButton: true,
					icon: "question"
				})

				if (isConfirmed) {
					location.href = "<?= base_url("/pengajuan/set_lock/" . $pengajuan->id) ?>"
				}
			}
		})(jQuery);

		function initDeleteEvent() {
			$(".btn-delete-file").each((i, e) => {
				e.addEventListener("click", async () => {
					const {
						isConfirmed
					} = await Swal.fire({
						title: "Apa anda yakin ?",
						text: "File akan hilang dari server",
						confirmButtonText: "Yakin",
						showCancelButton: true,
						icon: "question"
					})

					if (isConfirmed) {
						$.ajax({
							url: "<?= base_url("/wizard/delete_berkas/") ?>" + e.dataset.id,
							method: "POST",
							success(res) {
								const data = JSON.parse(res)
								Swal.fire("Berhasil", "File telah dihapus", "success").then(() => {
									$(`#class-content-p${data[1]} > div:nth-child(2)`).replaceWith(data[0])
								})
							},
							error(error) {
								Swal.fire("Terjadi kesalahan", error.responseText, "error")
							}
						})
					}
				})
			})
		}

		initDeleteEvent()

	})
</script>